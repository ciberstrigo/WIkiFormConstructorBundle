<?php

namespace WikiFormConstructorBundle\Controller\API\ObjectForm;

use WikiFormConstructorBundle\DTO\Assemblers\FormDataAssembler;
use WikiFormConstructorBundle\DTO\Assemblers\FormDataResultAssembler;
use WikiFormConstructorBundle\Entity\Objects\Form\FormResult;
use Symfony\Component\Security\Core\User\UserInterface;
use WikiFormConstructorBundle\Helpers\Response\Json\SuccessJsonResponse;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;


class FormResultController extends AbstractController
{

    private $em;

    /** @var UserInterface $user */
    private $user;

    private $dtoAssembler;

    private $formDataDtoAssembler;


    public function __construct(
        EntityManagerInterface $em,
        Security $security,
        FormDataAssembler $dtoAssembler,
        FormDataResultAssembler $formDataDtoAssembler
    ) {
        $this->user                 = $security->getUser();
        $this->em                   = $em;
        $this->dtoAssembler         = $dtoAssembler;
        $this->formDataDtoAssembler = $formDataDtoAssembler;
    }


    /**
     * @Route(
     *     path="/api/form_results/{id}",
     *     name="form_result_edit",
     *     methods={"GET"}
     *     )
     * @param FormResult          $formResult
     * @param FormDataAssembler   $formDataAssembler
     * @param NormalizerInterface $normalizer
     *
     * @return JsonResponse
     * @throws ExceptionInterface
     */
    public function getFormResult(FormResult $formResult, FormDataAssembler $formDataAssembler, NormalizerInterface $normalizer)
    {
        $form = $formResult->getForm();
        $dto  = $formDataAssembler->writeDTO($form, $formResult);
        $data = $normalizer->normalize($dto, 'json', [ 'groups' => [ 'forms_detail' ] ]);

        return SuccessJsonResponse::make($data);
    }

}