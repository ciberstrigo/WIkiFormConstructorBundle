<?php

namespace WikiFormConstructorBundle\Controller\API\ObjectForm;

use Symfony\Component\Security\Core\User\UserInterface;
use Throwable;
use WikiFormConstructorBundle\DTO\Assemblers\FormDataAssembler;
use WikiFormConstructorBundle\DTO\Assemblers\FormDataResultAssembler;
use WikiFormConstructorBundle\Entity\Objects\Form\Form as ObjectForm;
use WikiFormConstructorBundle\Entity\Objects\Form\FormStep;
use WikiFormConstructorBundle\Helpers\Response\Json\FailureJsonResponse;
use WikiFormConstructorBundle\Helpers\Response\Json\SuccessJsonResponse;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\ORMException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use WikiFormConstructorBundle\DTO\FormData\FormDataResultDTO;
use WikiFormConstructorBundle\Services\Forms\Validation\FormFieldValidator;

class ObjectFormController extends AbstractController
{

    private $em;

    /**
     * @var UserInterface $user
     */
    private $user;

    private $dtoAssembler;

    private $formDataDtoAssembler;

    /**
     * @var mixed|null
     */
    private $regionType;


    public function __construct(
        EntityManagerInterface $em,
        Security $security,
        FormDataAssembler $dtoAssembler,
        FormDataResultAssembler $formDataDtoAssembler
    ) {
        $this->user                           = $security->getUser();
        $this->em                             = $em;
        $this->dtoAssembler                   = $dtoAssembler;
        $this->formDataDtoAssembler           = $formDataDtoAssembler;
        $this->regionType                     = isset($_ENV['REGION_TYPE']) ? $_ENV['REGION_TYPE'] : null;
    }


    /**
     * @Route(
     *     path="/api/forms",
     *     name="api_forms_list",
     *     methods={"GET"}
     *     )
     *
     * @Route(
     *     path="/api/public/forms",
     *     methods={"GET"}
     * )
     * @param Request             $request
     * @param NormalizerInterface $normalizer
     *
     * @return JsonResponse
     * @throws ExceptionInterface
     */
    public function getForms(Request $request, NormalizerInterface $normalizer)
    {
        $qb    = $this->em->getRepository(ObjectForm::class)->getAllQueryBuilder();
        $forms = $normalizer->normalize($qb, 'json', [ 'groups' => [ 'forms_list' ] ]);

        return SuccessJsonResponse::make($forms);
    }


    /**
     * @Route(
     *     path="/api/forms",
     *     name="forms_create",
     *     methods={"POST"}
     *     )
     *
     * @Route(
     *     path="/api/public/forms",
     *     methods={"POST"}
     * )
     * @param Request             $request
     * @param NormalizerInterface $normalizer
     *
     * @param SerializerInterface $serializer
     *
     * @return JsonResponse
     * @throws ExceptionInterface
     */
    public function createDataForm(Request $request, NormalizerInterface $normalizer, SerializerInterface $serializer)
    {
        $json = json_decode($request->getContent(), true);

        /** @var ObjectForm $form */
        $form = $serializer->deserialize(json_encode($json['data']), ObjectForm::class, 'json');

        $stepsArr = new ArrayCollection();

        foreach ($json['formatting']['steps'] as $step) {
            $stepobj = new FormStep();

            $stepobj->setForm($form);
            $stepobj->setFormatting($step['elements']);
            $stepobj->setAlias($step['alias']);

            $stepsArr->add($stepobj);
        }

        $form->setSteps($stepsArr);
        $form->setTransitionLogic($json['formatting']['transition_logic']);
        $form->setVersion($json['version']);

        $this->em->persist($form);
        $this->em->flush();

        $form = $normalizer->normalize($form, 'json', [ 'groups' => [ 'forms_detail' ] ]);

        return SuccessJsonResponse::make($form);
    }


    /**
     * @Route(
     *     path="/api/forms/{id}",
     *     name="forms_update",
     *     methods={"PUT"}
     *     )
     *
     * @param ObjectForm          $oldForm
     * @param Request             $request
     *
     * @param NormalizerInterface $normalizer
     *
     * @param SerializerInterface $serializer
     *
     * @return JsonResponse
     * @throws ExceptionInterface
     * @throws ORMException
     */
    public function updateDataForm(ObjectForm $oldForm, Request $request, NormalizerInterface $normalizer, SerializerInterface $serializer)
    {
        $json = json_decode($request->getContent(), true);

        /** @var ObjectForm $form */
        $form = $serializer->deserialize(json_encode($json['data']), ObjectForm::class, 'json',
            [
                AbstractObjectNormalizer::DEEP_OBJECT_TO_POPULATE => true,
                AbstractObjectNormalizer::OBJECT_TO_POPULATE      => $oldForm
            ]
        );

        $stepsArr = new ArrayCollection();

        foreach ($json['formatting']['steps'] as $step) {
            $stepobj = new FormStep();

            $stepobj->setForm($oldForm);
            $stepobj->setFormatting($step['elements']);
            $stepobj->setAlias($step['alias']);

            $stepsArr->add($stepobj);
        }


        $oldForm->setSteps($stepsArr);
        $oldForm->setTransitionLogic($json['formatting']['transition_logic']);
        $oldForm->setVersion($json['version']);

        $this->em->merge($oldForm);
        $this->em->flush();

        $form = $normalizer->normalize($form, 'json', [ 'groups' => [ 'forms_detail' ] ]);

        return SuccessJsonResponse::make($form);
    }


    /**
     *
     * @Route("/api/forms/{id}", methods={"GET"},
     *     name="api_form_get",
     *     )
     *
     * @Route("/api/public/{id}", methods={"GET"},
     *     name="public_api_form_get",
     *     )
     * @param ObjectForm          $form
     * @param NormalizerInterface $normalizer
     *
     * @return JsonResponse
     * @throws ExceptionInterface
     */
    public function getForm(ObjectForm $form, NormalizerInterface $normalizer)
    {
        $dto  = $this->dtoAssembler->writeDTO($form);
        $data = $normalizer->normalize($dto, 'json', [ 'groups' => [ 'forms_detail' ] ]);

        return SuccessJsonResponse::make($data);
    }


    /**
     *
     * @Route("/api/forms/get_by_alias/{alias}/versions", methods={"GET"},
     *     name="get_versions",
     *     )
     *
     * @Route("/api/public/forms/get_by_alias/{alias}/versions", methods={"GET"},
     *     name="public_get_versions",
     *     )
     * @param                     $alias
     * @param NormalizerInterface $normalizer
     *
     * @return JsonResponse
     * @throws ExceptionInterface
     */
    public function getFormVersions($alias, NormalizerInterface $normalizer)
    {
        $forms = $this->em->getRepository(ObjectForm::class)->findBy([
            'alias' => $alias
        ]);

        if (empty($forms)) {
            return FailureJsonResponse::make([], 'Форма не найдена', 404);
        }

        $data = $normalizer->normalize($forms, 'json', [ 'groups' => [ 'forms_list' ] ]);

        return SuccessJsonResponse::make($data);
    }


    /**
     * @Route(
     *     path="/api/forms/get_by_alias/{alias}",
     *     name="forms_alias_detail",
     *     methods={"GET"}
     *     )
     *
     * @Route(
     *     path="/api/public/forms/get_by_alias/{alias}",
     *     name="public_forms_alias_detail",
     *     methods={"GET"}
     *    )
     * @param Request             $request
     * @param                     $alias
     *
     * @param NormalizerInterface $normalizer
     *
     * @return JsonResponse
     * @throws ExceptionInterface
     */
    public function getFormByAlias(Request $request, $alias, NormalizerInterface $normalizer)
    {
        $version = $request->get('version', null);

        if ( ! is_null($version)) {
            $form = $this->em->getRepository(ObjectForm::class)->findOneBy([
                'version' => $version,
                'alias'   => $alias
            ]);

            if ( ! $form) {
                $form = $this->em->getRepository(ObjectForm::class)->findLastForm($alias);
            }
        } else {
            $form = $this->em->getRepository(ObjectForm::class)->findLastForm($alias);
        }

        if ( ! $form) {
            try {
                $form = $this->em->getRepository(ObjectForm::class)->find($alias);
            } catch (Throwable $exception) {
                $form = null;
            }
        }

        if ( ! $form) {
            return FailureJsonResponse::make([], 'Форма не найдена', 404);
        }

        if ( ! $this->isGranted('show', $form)) {
            return FailureJsonResponse::make([], 'У вас нет доступа для просмотра данной формы', 403);
        }

        $dto  = $this->dtoAssembler->writeDTO($form);
        $data = $normalizer->normalize($dto, 'json', [ 'groups' => [ 'forms_detail' ] ]);

        return SuccessJsonResponse::make($data);
    }


    /**
     * @Route("/api/forms/{id}/send", name="api_form_send_data", methods={"POST"})
     *
     * @Route("/api/public/forms/{id}/send", name="api_public_form_send_data", methods={"POST"})
     *
     * @param Request                     $request
     * @param ObjectForm                  $form
     *
     * @param FormFieldValidator          $formFieldValidator
     *
     *
     * @return JsonResponse
     * @throws \Exception
     */
    public function sendObjectForm(
        Request $request,
        ObjectForm $form,
        FormFieldValidator $formFieldValidator
    ) {
        $formData = json_decode($request->getContent(), true);

        $data = array_shift($formData);
        $data = array_reverse($data);

        $formResultDTO = new FormDataResultDTO();

        $formResultDTO->setForm($form);
        $formResultDTO->setValues($data);

        $formResult = $this->formDataDtoAssembler->readDTO($formResultDTO);
        $validation = $formFieldValidator->validate($formResult);

        $this->em->persist($formResult);

        if (is_array($validation)) {
            $error   = array_shift($validation['errors']);
            $message = $validation['message'] . ': "' . $error['field']['title'] . '" ' . $error['message'];

            throw new \Exception($message);
        }

        $this->em->flush();

        return SuccessJsonResponse::make([]);
    }


    /**
     * @Route(
     *     path="/api/forms/{id}/remove",
     *     methods={"GET"},
     *     name="api_forms_delete"
     * )
     * @param ObjectForm $form
     *
     * @return JsonResponse
     */
    public function removeObjectType(ObjectForm $form)
    {

        try {
            $this->em->remove($form);
            $this->em->flush();
        } catch (Throwable $exception) {
            return FailureJsonResponse::make([], $exception->getMessage());
        }

        return SuccessJsonResponse::make([], 'Форма успешно удалена');
    }
}