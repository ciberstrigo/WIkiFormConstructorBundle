<?php

namespace WikiFormConstructorBundle\DTO\Assemblers;

use WikiFormConstructorBundle\DTO\FormData\FormDataDTO;
use WikiFormConstructorBundle\Entity\Objects\Form\Form;
use WikiFormConstructorBundle\Entity\Objects\Form\FormField;
use WikiFormConstructorBundle\Entity\Objects\Form\FormObject;
use WikiFormConstructorBundle\Entity\Objects\Form\FormResult;
use WikiFormConstructorBundle\Entity\Objects\Form\FormStep;
use WikiFormConstructorBundle\Entity\Objects\Form\FormObjectRelation;
use Symfony\Component\Security\Core\User\UserInterface as User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;
use Doctrine\Common\Collections\ArrayCollection;

class FormDataAssembler
{

    private $formDataResultAssembler;

    /**
     * @var Security
     */
    private $security;

    private $deniedFieldsAliases;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;


    private function searchElementByAlias($alias, Form $form)
    {
        $aliasLevel = count(explode('/', $alias));

        switch ($aliasLevel) {
            case 1:
                if ($form->getAlias() === $alias) {
                    return $form;
                }

                break;

            case 2:
                foreach ($form->getObjects() as $object) {
                    if ($object->getFullAliasPath() === $alias) {
                        return $object;
                    }
                }

                break;

            case 3:
                foreach ($form->getObjects() as $object) {
                    foreach ($object->getFields() as $formField) {
                        if ($formField->getFullAliasPath() === $alias) {
                            return $formField;
                        }
                    }
                }
        }

        return null;
    }


    public function __construct(FormDataResultAssembler $formDataResultAssembler, Security $security, EntityManagerInterface $entityManager)
    {
        $this->formDataResultAssembler = $formDataResultAssembler;
        $this->security                = $security;
        $this->entityManager           = $entityManager;
    }


    public function readDTO(FormDataDTO $formDataDTO, ?Form $form = null): Form
    {
        if ( ! $form) {
            if ( ! $formDataDTO->getData()) {
                $form = new Form();
            } else {
                $form = $formDataDTO->getData();
            }
        }

        foreach ($form->getObjects() as $formObject) {
            $formObject->setForm($form);

            foreach ($formObject->getFields() as $formField) {
                $formField->setFormObject($formObject);
            }
        }

//        $relationsArray = new ArrayCollection();

        //foreach ($formDataDTO->getRelations() as $relation) {
        //    $relationObj = new FormObjectRelation();
        //
        //    $relationObj->setForm($form);
        //
        //    $subjectEntity = $this->searchElementByAlias($relation['subject'], $form);
        //
        //    if ($subjectEntity instanceof FormField) {
        //        $subject = new DataObjectFieldRelationSubject();
        //    } else {
        //        $subject = new DataObjectRelationSubject();
        //    }
        //
        //    $subject->setEntity($subjectEntity);
        //    $relationObj->setSubject($subject);
        //
        //    $objectEntity = $this->searchElementByAlias($relation['object'], $form);
        //
        //    if ($objectEntity instanceof FormField) {
        //        $object = new DataObjectFieldRelationObject();
        //    } else {
        //        $object = new DataObjectRelationObject();
        //    }
        //
        //    $object->setEntity($objectEntity);
        //    $relationObj->setObject($object);
        //
        //    $relationObj->setPredicate($relation['predicate']);
        //
        //    $relationsArray->add($relationObj);
        //}
        //
        //$form->setRelations($relationsArray);

        $form->setVersion($formDataDTO->getVersion());

        $stepsArray = new ArrayCollection();

        foreach ($formDataDTO->getFormatting()['steps'] as $step) {
            $stepObject = new FormStep();

            $stepObject->setForm($form);
            $stepObject->setAlias($step['alias']);
            $stepObject->setFormatting($step['elements']);

            $stepsArray->add($stepObject);
        }

        $logic = $formDataDTO->getFormatting()['steps']['transition_logic'];

        $form->setTransitionLogic($logic);
        $form->setSteps($stepsArray);

        return $form;
    }


    public function updateArticle(Form $form, FormDataDTO $formDataDTO): Form
    {
        return $this->readDTO($formDataDTO, $form);
    }


    public function createArticle(FormDataDTO $formDataDTO): Form
    {
        return $this->readDTO($formDataDTO);
    }


    public function writeDTO(Form $form, ?FormResult $formResult = null): FormDataDTO
    {
        $formDataDTO = new FormDataDTO();

        $formDataDTO->setData($form);

        $deniedFieldsAliases = [];//$this->getAccessDeniedFieldsAliases($form, $formResult);
        $relationsArray      = [];

        foreach ($form->getRelations() as $relation) {
            $relationArray = [
                'subject' => $relation->getSubject()->getFullAliasPath(),
                'object'  => $relation->getObject()->getFullAliasPath()
            ];

            $relationsArray[] = $relationArray;
        }

        $formDataDTO->setRelations($relationsArray);

        $fieldValues   = $this->formDataResultAssembler->writeDTO($form, $formResult);
        $clearedValues = $this->removeAccessDeniedFieldsFromValues($fieldValues->getValues(), $deniedFieldsAliases);

        $formDataDTO->setValues($clearedValues);

        $formattingArray = [
            'steps'            => [],
            'transition_logic' => $form->getTransitionLogic()
        ];

        foreach ($form->getSteps() as $step) {
            $stepArray = [
                'alias'    => $step->getAlias(),
                'elements' => $this->removeAccessDeniedFieldsFromFormatting($step->getFormatting(), $deniedFieldsAliases)
            ];

            $formattingArray['steps'][] = $stepArray;
        }

        $formDataDTO->setFormatting($formattingArray);
        $formDataDTO->setVersion($form->getVersion());
        $formDataDTO->setCreatedAt($form->getCreatedAt());

        return $formDataDTO;
    }


//    private function getAccessDeniedFieldsAliases(Form $form, ?FormResult $formResult = null, DataObject $dataObject = null): array
//    {
//        $aliases = [];
//
//        /** @var User $user */
//        $user = $this->security->getUser();
//
//        $creatorFind    = true;
//        $fullPrivileges = false;
//
//        if ($formResult) {
//            foreach ($formResult->getObjects() as $formResultObject) {
//                if ( ! $formResultObject->getCreatedObject()) {
//                    $createdObject = $formResultObject->getCreatedObject();
//
//                    if ( ! $createdObject->getType()) {
//                        continue;
//                    }
//
//                    $createdObjectType = $createdObject->getType();
//
//                    if ($createdObjectType->getId() !== '82b87a06-17ff-4d5e-8325-e9d3967eb904') {
//                        continue;
//                    }
//
//                    if ( ! $createdObject->getCreator()) {
//                        continue;
//                    }
//
//                    /** @var User $creator */
//                    $creator = $createdObject->getCreator();
//
//                    if ($creator->getId() === $user->getId()) {
//                        $fullPrivileges = true;
//                    }
//
//                    //foreach ($createdObject->getValues() as $createdObjectValue) {
//                    //    if ( ! $createdObjectValue instanceof ObjectLinkValue) {
//                    //        /** @var DataObject $objectPersonValue */
//                    //        $objectPersonValue = $createdObjectValue->getValue();
//                    //
//                    //        if ( ! $objectPersonValue) {
//                    //            continue;
//                    //        }
//                    //
//                    //        if ( ! $createdObjectValue->getObjectTypeField() || $createdObjectValue->getObjectTypeField()->getId() !== '8d781459-c7dd-4999-987f-256852f619bb') {
//                    //            continue;
//                    //        }
//                    //
//                    //        foreach ($objectPersonValue->getValues() as $objectPersonField) {
//                    //            if ( ! $objectPersonField->getObjectTypeField() || $objectPersonField->getObjectTypeField()->getId() !== '03bd5084-f0b1-4397-8e90-a23ddad9e478') {
//                    //                continue;
//                    //            }
//                    //
//                    //            $username = $objectPersonField->getValue();
//                    //            /** @var User $taskUser */
//                    //            $taskUser = $this->entityManager->getRepository(User::class)->findOneBy([
//                    //                'username' => $username
//                    //            ]);
//                    //
//                    //            if ($taskUser) {
//                    //                if ($taskUser->getId() === $user->getId()) {
//                    //                    $creatorFind = true;
//                    //                }
//                    //            }
//                    //        }
//                    //    }
//                    //}
//                }
//            }
//        }
//
//        if ($dataObject) {
//            $createdObject = $dataObject;
//
//            if ($createdObject->getType()) {
//                $createdObjectType = $createdObject->getType();
//
//                if ($createdObjectType->getId() === '82b87a06-17ff-4d5e-8325-e9d3967eb904') {
//                    if ($createdObject->getCreator()) {
//                        /** @var User $creator */
//                        $creator = $createdObject->getCreator();
//
//                        if ($creator->getId() === $user->getId()) {
//                            $fullPrivileges = true;
//                        }
//
//                        //dd($createdObjectType);
//                        //foreach ($createdObject->getValues() as $createdObjectValue) {
//                        //    if ( ! $createdObjectValue instanceof ObjectLinkValue) {
//                        //        continue;
//                        //    }
//                        //
//                        //    /** @var DataObject $objectPersonValue */
//                        //    $objectPersonValue = $createdObjectValue->getValue();
//                        //
//                        //    if ( ! $objectPersonValue) {
//                        //        continue;
//                        //    }
//                        //
//                        //    if ( ! $createdObjectValue->getObjectTypeField() || $createdObjectValue->getObjectTypeField()->getId() !== '8d781459-c7dd-4999-987f-256852f619bb') {
//                        //        continue;
//                        //    }
//                        //
//                        //    foreach ($objectPersonValue->getValues() as $objectPersonField) {
//                        //        if ( ! $objectPersonField->getObjectTypeField() || $objectPersonField->getObjectTypeField()->getId() !== '03bd5084-f0b1-4397-8e90-a23ddad9e478') {
//                        //            continue;
//                        //        }
//                        //
//                        //        $username = $objectPersonField->getValue();
//                        //
//                        //        /** @var User $taskUser */
//                        //        $taskUser = $this->entityManager->getRepository(User::class)->findOneBy([
//                        //            'username' => $username
//                        //        ]);
//                        //
//                        //        if ($taskUser) {
//                        //            if ($taskUser->getId() === $user->getId()) {
//                        //                $creatorFind = true;
//                        //            }
//                        //        }
//                        //    }
//                        //
//                        //}
//                    }
//                }
//            }
//        }
//
//        if ($user->isAdminPanelAllow() || ( ! $formResult && ! $dataObject)) {
//            $fullPrivileges = true;
//        }
//
//        foreach ($form->getObjects() as $formObject) {
//            /** @var FormObject $formObject */
//            $newFields = new ArrayCollection();
//
//            foreach ($formObject->getFields() as $formField) {
//                if ( ! $formField->getObjectTypeField()) {
//                    continue;
//                }
//
//                $isGranted = $this->security->isGranted('show', $formField->getObjectTypeField());
//
//                if ( ! $isGranted) {
//                    $aliases[] = $formField->getFullAliasPath();
//                    $newFields->add($formField);
//                } else {
//                    if ( ! $fullPrivileges) {
//                        if ($creatorFind) {
//                            if ($formObject->getObjectType() && $formObject->getObjectType()->getId() === '82b87a06-17ff-4d5e-8325-e9d3967eb904') {
//                                if ($formField->getObjectTypeField() && $formField->getObjectTypeField()->getId() !== '2d9dee0e-e7da-43a5-b078-bdb539321bcd') {
//                                    $aliases[] = $formField->getFullAliasPath();
//                                } else {
//                                    $newFields->add($formField);
//                                }
//                            } else {
//                                $newFields->add($formField);
//                            }
//                        } else {
//                            if ($formObject->getObjectType() && $formObject->getObjectType()->getId() === '82b87a06-17ff-4d5e-8325-e9d3967eb904') {
//                                $aliases[] = $formField->getFullAliasPath();
//                            } else {
//                                $newFields->add($formField);
//                            }
//                        }
//                    } else {
//                        $newFields->add($formField);
//                    }
//                }
//
//
//            }
//
//            $formObject->setFields($newFields);
//        }
//
//        $this->deniedFieldsAliases = $aliases;
//
//        return $aliases;
//    }


    private function removeElementByValue($arr, $val)
    {
        $return = [];
        $nulls  = false;

        foreach ($arr as $k => $v) {
            if (is_array($v)) {
                if (isset($v['field']) && $v['field'] === $val) {
                    continue;
                } else {
                    $arrVal = $this->removeElementByValue($v, $val);

                    if (null === $arrVal) {
                        $nulls = true;

                        continue;
                    }

                    $return[$k] = $arrVal;

                    if ($k === 'children' && empty($return[$k])) {
                        unset($return[$k]);

                        return null;
                    }

                    continue;
                }
            }

            $return[$k] = $v;
        }

        if ($nulls) {
            return array_values($return);
        } else {
            return $return;
        }
    }


    private function removeAccessDeniedFieldsFromFormatting(array $formatting, array $deniedFieldsAliases): array
    {
        foreach ($deniedFieldsAliases as $alias) {
            $formatting = $this->removeElementByValue($formatting, $alias);
        }

        return $formatting;
    }


    private function removeAccessDeniedFieldsFromValues(array $values, array $deniedFieldsAliases): array
    {
        foreach ($values as $objectAlias => &$object) {
            foreach ($object as &$objectFields) {
                foreach ($objectFields as $fieldAlias => $fieldValue) {
                    if (in_array($objectAlias . '/' . $fieldAlias, $deniedFieldsAliases)) {
                        unset($objectFields[$fieldAlias]);
                    }
                }

                if (empty($values[$objectAlias])) {
                    unset($values[$objectAlias]);
                }
            }
        }

        return $values;
    }


//    public function loadDataObject(FormDataDTO $formDataDTO, DataObject $dataObject)
//    {
//        $formDataDTO = $this->formDataResultAssembler->fillValuesByObject($formDataDTO, $dataObject);
//        $aliases     = $this->getAccessDeniedFieldsAliases($formDataDTO->getData(), null, $dataObject);
//        //$clearedValues     = $this->removeAccessDeniedFieldsFromValues($formDataDTO->getValues(), $aliases);
//        $clearedFormatting = $this->removeAccessDeniedFieldsFromFormatting($formDataDTO->getFormatting(), $aliases);
//        //$clearedValues = $formDataDTO->getValues();
//
//        //$formDataDTO->setValues($clearedValues);
//        $formDataDTO->setFormatting($clearedFormatting);
//
//        return $formDataDTO;
//    }
}