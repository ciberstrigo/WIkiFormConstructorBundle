<?php

namespace WikiFormConstructorBundle\DTO\Assemblers;

use WikiFormConstructorBundle\DTO\FormData\FormDataDTO;
use WikiFormConstructorBundle\DTO\FormData\FormDataResultDTO;
//use WikiFormConstructorBundle\Entity\Objects\DataObject;
use WikiFormConstructorBundle\Entity\Objects\Form\Form;
use WikiFormConstructorBundle\Entity\Objects\Form\FormField;
use WikiFormConstructorBundle\Entity\Objects\Form\FormObject;
use WikiFormConstructorBundle\Entity\Objects\Form\FormResult;
use WikiFormConstructorBundle\Entity\Objects\Form\FormResultObject;
use WikiFormConstructorBundle\Entity\Objects\Form\FormResultValue;
//use WikiFormConstructorBundle\Entity\Objects\ObjectType;
//use WikiFormConstructorBundle\Entity\Objects\ObjectTypeField;
//use WikiFormConstructorBundle\Entity\Objects\Values\ObjectLinkValue;
use Symfony\Component\Security\Core\User\UserInterface as User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface;
use Symfony\Component\Security\Core\Security;
use WikiFormConstructorBundle\Helpers\Response\Json\FailureJsonResponse;

class FormDataResultAssembler
{

    /**
     * @var Security
     */
    private $security;

    /**
     * @var AccessDecisionManagerInterface
     */
    private $accessDecisionManager;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;


    public function __construct(Security $security, AccessDecisionManagerInterface $accessDecisionManager, EntityManagerInterface $entityManager)
    {

        $this->security              = $security;
        $this->accessDecisionManager = $accessDecisionManager;
        $this->entityManager         = $entityManager;
    }


//    private function searchDataObjectsFieldValuesForFormField(DataObject $dataObject, FormField $formField)
//    {
//        $values = [];
//
//        foreach ($dataObject->getValues() as $value) {
//            /** @var ObjectTypeField $objectTypeField */
//            $objectTypeField = $value->getObjectTypeField();
//
//            if ( ! $formField->getObjectTypeField() || ! $objectTypeField) {
//                continue;
//            }
//
//            $token     = new UsernamePasswordToken($this->security->getUser(), 'none', 'none', $this->security->getUser()->getRoles());
//            $isGranted = $this->accessDecisionManager->decide($token, [ 'show' ], $objectTypeField);
//
//            if ($objectTypeField->getId() === $formField->getObjectTypeField()->getId()) {
//                if ($isGranted) {
//                    if ($value instanceof ObjectLinkValue) {
//                        $values[] = $value->getValue() ? $value->getValue()->getId() : "";
//                    } else {
//                        $values[] = $value->getValue();
//                    }
//                } else {
//                    if ($value instanceof ObjectLinkValue) {
//                        $values[] = "";
//                    } else {
//                        $values[] = "Доступ запрещён";
//                    }
//                }
//
//            }
//        }
//
//        return $values;
//    }


//    private function parseFieldValueFromFormField(FormField $formField, &$fieldValuesArray, DataObject $dataObject = null)
//    {
//        $newValuesArray = [];
//
//        if ($dataObject) {
//            $values = $this->searchDataObjectsFieldValuesForFormField($dataObject, $formField);
//
//            if ($formField->isMultiple()) {
//                if ( ! empty($values)) {
//                    foreach ($values as $value) {
//                        $newValuesArray[$formField->getAlias()][] = $value;
//                    }
//                } else {
//                    $newValuesArray[$formField->getAlias()][] = $formField->getDefaultValue() ? $formField->getDefaultValue() : "";
//                }
//            } else {
//                if ( ! empty($values)) {
//                    $newValuesArray[$formField->getAlias()] = array_pop($values);
//                } else {
//                    $newValuesArray[$formField->getAlias()] = $formField->getDefaultValue() ? $formField->getDefaultValue() : "";
//                }
//            }
//
//        } else {
//            if ($formField->isMultiple()) {
//                $newValuesArray[$formField->getAlias()][] = $formField->getDefaultValue() ? $formField->getDefaultValue() : "";
//            } else {
//                $newValuesArray[$formField->getAlias()] = $formField->getDefaultValue() ? $formField->getDefaultValue() : "";
//            }
//        }
//
//        return $newValuesArray;
//    }


    private function parseFieldValuesFromForm(Form $form, $parentId = null)
    {
        $fieldValuesArray = [];

        foreach ($form->getObjects() as $object) {
            $parent       = $object->getParent();
            $parentTempId = $parent ? $parent->getId() : null;

            if (is_null($parentId) && is_null($parentTempId)) {
                $fieldValues = [];

                foreach ($object->getFields() as $formField) {
//                    $fieldValues = array_merge($fieldValues, $this->parseFieldValueFromFormField($formField, $fieldValuesArray));
                }

                if ($object->isMultiple()) {
                    if (isset($fieldValuesArray[$object->getFullAliasPath()])) {
                        $fieldValuesArray[$object->getFullAliasPath()][] = $fieldValues;
                    } else {
                        $fieldValuesArray[$object->getFullAliasPath()] = [ $fieldValues ];
                    }
                } else {
                    $fieldValuesArray[$object->getFullAliasPath()] = [ $fieldValues ];
                }
            }

            if (is_null($parentId) && ! is_null($parentTempId)) {

                if (isset($fieldValuesArray[$parent->getFullAliasPath()])) {
                    foreach ($object->getFields() as $formField) {
//                        $this->parseFieldValueFromFormField($formField, $fieldValuesArray[$parent->getFullAliasPath()]);
                    }

                    $fieldVals                                     = $this->parseFieldValuesFromForm($form, $object->getId());
                    $fieldValuesArray[$parent->getFullAliasPath()] = array_merge($fieldValuesArray[$parent->getFullAliasPath()], $fieldVals);
                }
            }

            if ( ! is_null($parentId) && ! is_null($parentTempId)) {
                if ($parentId === $object->getId()) {
                    foreach ($object->getFields() as $formField) {
//                        $this->parseFieldValueFromFormField($formField, $fieldValuesArray);
                    }
                } else {
                    if ($parentId === $parentTempId) {
                        $fieldVals                                     = $this->parseFieldValuesFromForm($form, $object->getId());
                        $fieldValuesArray[$parent->getFullAliasPath()] = array_merge($fieldValuesArray[$parent->getFullAliasPath()], $fieldVals);
                    }
                }
            }
        }

        ///* TODO */
        //foreach ($fieldValuesArray as &$value) {
        //    if (is_array($value)) {
        //        $value = [ $value ];
        //    }
        //}

        return $fieldValuesArray;
    }


    private function parseFieldValuesFromFormResultObject(FormResultObject $object)
    {
        $fieldValuesArray = [];

        foreach ($object->getValues() as $value) {
            $fieldValuesArray[$value->getField()->getAlias()] = $value->getValue();
        }

        foreach ($object->getChildren() as $child) {
            $fieldValuesArray[$child->getFormObject()->getFullAliasPath()][] = $this->parseFieldValuesFromFormResultObject($child);
        }

        return $fieldValuesArray;
    }


    private function parseFieldValuesFromFormResult(FormResult $formResult)
    {
        $fieldValuesArray = [];

        foreach ($formResult->getObjects() as $formResultObject) {
            if ( ! $formResultObject->getParent() && $formResultObject->getFormObject() && $formResultObject->getFormObject()->getForm()) {
                $fieldValuesArray[$formResultObject->getFormObject()->getFullAliasPath()][] = $this->parseFieldValuesFromFormResultObject($formResultObject);
            }
        }

        return $fieldValuesArray;
    }


//    private function parseFieldValuesFromObject(DataObject $dataObject, Form $form, $parentId = null, $existedValues = [])
//    {
//        $fieldValuesArray = $existedValues;
//
//        /** @var User $user */
//        $user = $this->security->getUser();
//
//        $creatorFind = false;
//
//        $createdObject = $dataObject;
//
//        if ($createdObject->getType()) {
//            $createdObjectType = $createdObject->getType();
//
//            if ($createdObjectType->getId() === '82b87a06-17ff-4d5e-8325-e9d3967eb904') {
//                if ($createdObject->getCreator()) {
//                    /** @var User $creator */
//                    $creator = $createdObject->getCreator();
//
//                    if ($creator->getId() === $user->getId()) {
//                        $creatorFind = true;
//                    }
//
//                    if ($user->isAdminPanelAllow()) {
//                        $creatorFind = true;
//                    }
//                }
//            }
//        }
//
//        foreach ($form->getObjects() as $object) {
//            $parent       = $object->getParent();
//            $parentTempId = $parent ? $parent->getId() : null;
//
//            if (is_null($parentId) && is_null($parentTempId)) {
//                $fieldValues = [];
//
//                foreach ($object->getFields() as $formField) {
//                    if ($object->getObjectType() && $object->getObjectType() === '82b87a06-17ff-4d5e-8325-e9d3967eb904') {
//                        if ($formField->getObjectTypeField() && $formField->getObjectTypeField()->getId() === '2d9dee0e-e7da-43a5-b078-bdb539321bcd') {
//                            if ($creatorFind) {
//                                $fieldValues = array_merge($fieldValues, $this->parseFieldValueFromFormField($formField, $fieldValuesArray, $dataObject));
//                            }
//                        }
//                    } else {
//                        $fieldValues = array_merge($fieldValues, $this->parseFieldValueFromFormField($formField, $fieldValuesArray, $dataObject));
//                    }
//                }
//
//                if (isset($fieldValuesArray[$object->getFullAliasPath()])) {
//                    $fieldValuesArray[$object->getFullAliasPath()][] = $fieldValues;
//                } else {
//                    $fieldValuesArray[$object->getFullAliasPath()] = [ $fieldValues ];
//                }
//            }
//
//            if (is_null($parentId) && ! is_null($parentTempId)) {
//                if (isset($fieldValuesArray[$parent->getFullAliasPath()])) {
//                    foreach ($object->getFields() as $formField) {
//                        $this->parseFieldValueFromFormField($formField, $fieldValuesArray[$parent->getFullAliasPath()], $dataObject);
//                    }
//
//                    $fieldVals                                     = $this->parseFieldValuesFromObject($dataObject, $form, $object->getId());
//                    $fieldValuesArray[$parent->getFullAliasPath()] = array_merge($fieldValuesArray[$parent->getFullAliasPath()], $fieldVals);
//                }
//            }
//
//            if ( ! is_null($parentId) && ! is_null($parentTempId)) {
//                if ($parentId === $object->getId()) {
//                    foreach ($object->getFields() as $formField) {
//                        $this->parseFieldValueFromFormField($formField, $fieldValuesArray, $dataObject);
//                    }
//                } else {
//                    if ($parentId === $parentTempId) {
//                        $fieldVals                                     = $this->parseFieldValuesFromObject($dataObject, $form, $object->getId());
//                        $fieldValuesArray[$parent->getFullAliasPath()] = array_merge($fieldValuesArray[$parent->getFullAliasPath()], $fieldVals);
//                    }
//                }
//            }
//        }
//
//        ///* TODO */
//        //foreach ($fieldValuesArray as &$value) {
//        //    if (is_array($value)) {
//        //        $value = [ $value ];
//        //    }
//        //}
//
//        return $fieldValuesArray;
//    }


    public function readDTO(FormDataResultDTO $formDataResultDto, $subObjectIds = []): FormResult
    {
        $formResult = new FormResult();
        $form       = $formDataResultDto->getForm();

        $formResult->setForm($form);

        $values = $formDataResultDto->getValues();

        $sortIndex = 0;

        foreach ($values as $alias => $object) {
            foreach ($object as $value) {
                /** @var FormObject $formObject */
                $formObject       = $this->searchElementByAlias($alias, $form);
                $formResultObject = new FormResultObject();

                $formResultObject->setSort($sortIndex);
                $formResultObject->setFormObject($formObject);
                $formResultObject->setFormResult($formResult);

                $this->parseFormResultValues($value, $alias, $form, $formResult, $formResultObject, null, $subObjectIds);

                $sortIndex++;
            }
        }

        foreach ($form->getRelations() as $relation) {
            $object  = $relation->getObject();
            $subject = $relation->getSubject();

            foreach ($formResult->getObjects() as &$resultObject) {
                foreach ($resultObject->getValues() as &$formResultValue) {
                    if ($subject->getId() === $formResultValue->getField()->getId()) {
                        foreach ($formResult->getObjects() as &$resultSubObject) {
                            if ($resultSubObject->getFormObject()->getId() === $object->getId()) {
                                $formResultValue->setValue($resultSubObject->getId());
                            }
                        }
                    }
                }

            }
        }

        return $formResult;
    }


//    public function fillValuesByObject(FormDataDTO $formDataDTO, DataObject $dataObject)
//    {
//        //$form = $dataObject->getType()->getDefaultForm();
//        $form          = $formDataDTO->getData();
//        $existedValues = $formDataDTO->getValues();
//
//        $values = $this->parseFieldValuesFromObject($dataObject, $form, null, $existedValues);
//
//        $formDataDTO->setValues($values);
//
//        return $formDataDTO;
//    }


    private function parseFormResultValues(
        $values,
        $objectAlias,
        Form $form,
        FormResult $formResult,
        FormResultObject $formResultObject,
        FormResultObject $parentFormResultObject = null,
        $subObjectIds = []
    ) {
        foreach ($values as $alias => $value) {
            $aliasLevel = count(explode('/', $alias));

            $aliasParts         = explode('/', $alias);
            $lastAliasPart      = array_pop($aliasParts);
            $isLastAliasNumeric = is_numeric($lastAliasPart);

            if ($isLastAliasNumeric) {
                /** @var FormObject $newFormObject */
                $newFormObject = $this->searchElementByAlias($objectAlias, $form);

                $newFormResultObject = new FormResultObject();

                $newFormResultObject->setFormObject($newFormObject);
                $newFormResultObject->setFormResult($formResult);

                $this->parseFormResultValues($value, $objectAlias, $form, $formResult, $newFormResultObject, $formResultObject, $subObjectIds);
            } elseif ($aliasLevel === 1) {
                $alias = $objectAlias . '/' . $alias;

                /** @var FormField $formObjectField */
                $formObjectField = $this->searchElementByAlias($alias, $form);

                if (null === $formObjectField) {
                    throw new \Exception(\sprintf('Поле %s не существует.', $alias));
                }

                if ( ! is_array($value)) {
                    $value = [ $value ];
                }

                foreach ($value as $subValue) {
                    $formResultValue = new FormResultValue();
                    $formResultValue->setResultObject($formResultObject);

                    if (isset($subObjectIds[$subValue])) {
                        $subValue = $subObjectIds[$subValue];
                    }

                    $formResultValue->setValue($subValue);
                    $formResultValue->setField($formObjectField);
                    $formResultObject->addValue($formResultValue);
                }
            } else {
                foreach ($value as $objAlias => $object) {
                    /** @var FormObject $newFormObject */
                    $newFormObject = $this->searchElementByAlias($alias, $form);

                    $newFormResultObject = new FormResultObject();

                    $newFormResultObject->setFormObject($newFormObject);
                    $newFormResultObject->setFormResult($formResult);

                    $this->parseFormResultValues($object, $alias, $form, $formResult, $newFormResultObject, $formResultObject, $subObjectIds);
                }
            }
        }

        if ($parentFormResultObject) {
            $formResultObject->setParent($parentFormResultObject);
        }

        $formResult->addObject($formResultObject);
    }


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
                /** @var FormObject $object */
                foreach ($form->getObjects() as $object) {
                    /** @var FormField $formField */
                    foreach ($object->getFields() as $formField) {
                        if ($formField->getFullAliasPath() === $alias) {
                            return $formField;
                        }
                    }
                }
        }

        return null;
    }


    public function writeDTO(Form $form, ?FormResult $formResult = null): FormDataResultDTO
    {
        $formDataResultDto = new FormDataResultDTO();

        $formDataResultDto->setForm($form);

        if ($formResult) {
            if ($formResult->getForm()->getId() !== $form->getId()) {
                throw new \LogicException('Passed form with form in form result doesn\'t match');
            }

            $values = $this->parseFieldValuesFromFormResult($formResult);
        } else {
            $values = $this->parseFieldValuesFromForm($form);

            $formResult = new FormResult();
            $formResult->setForm($form);
        }

        $formDataResultDto->setValues($values);

        return $formDataResultDto;
    }


    public function getObjectsByFormResult(FormResult $formResult)
    {
        $formSortedObjects = [];
        $dataObjects       = [];

        $form = $formResult->getForm();

        if ( ! $form) {
            return $dataObjects;
        }

        $objectAliases = [];

        foreach ($form->getSteps() as $formStep) {
            $objectAliases = array_merge($objectAliases, $this->parseObjectAliasesFromFormatting($formStep->getFormatting(), $objectAliases));
        }

        foreach ($objectAliases as $objectAlias) {
            if (null !== $formObject = $this->searchElementByAlias($objectAlias, $form)) {
                $formSortedObjects[] = $formObject;
            }
        }

        return $dataObjects;
    }


    private function parseObjectAliasesFromFormatting(array $formatting, array &$aliases = [])
    {
        foreach ($formatting as $index => $value) {
            if (isset($value['object'])) {
                $aliases[] = $value['object'];
            }

            if (isset($value['children'])) {
                $this->parseObjectAliasesFromFormatting($value['children'], $aliases);
            }
        }

        return $aliases;
    }


    private function prepareLinkFieldValue(FormField $formField, $value)
    {
        if (Uuid::isValid($value)) {
            return $value;
        }

        //$formFieldSettings = $formField->getSettings();
        //
        //if (isset($formFieldSettings['linked_object_type_id']) && Uuid::isValid($formFieldSettings['linked_object_type_id'])) {
        //    /** @var ObjectType $objectType */
        //    $objectType = $this->entityManager->getRepository(ObjectType::class)->find($formFieldSettings['linked_object_type_id']);
        //
        //    if ( ! $objectType) {
        //        return '';
        //    }
        //
        //    $dataObjects = $this->entityManager->getRepository(DataObject::class)->getByObjectType($objectType, $value)->getQuery()->getResult();
        //
        //    if ( ! empty($dataObjects)) {
        //        $dataObject = array_shift($dataObjects);
        //
        //        return $dataObject->getId();
        //    }
        //}

        return '';
    }
}
