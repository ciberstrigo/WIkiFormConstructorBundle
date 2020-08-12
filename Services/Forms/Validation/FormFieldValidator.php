<?php

namespace WikiFormConstructorBundle\Services\Forms\Validation;

use WikiFormConstructorBundle\Entity\Objects\Form\FormField;
use WikiFormConstructorBundle\Entity\Objects\Form\FormResult;
use WikiFormConstructorBundle\Services\Forms\Validation\Classes\ValidationClass;
use WikiFormConstructorBundle\Services\Forms\Validation\ValidationClassManager;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\Uuid;

class FormFieldValidator
{

    private $em;

    private $validationClassManager;


    public function __construct(EntityManagerInterface $em, ValidationClassManager $manager)
    {
        $this->em                     = $em;
        $this->validationClassManager = $manager;
    }


    private function getFieldValidationClasses(FormField $field)
    {
        $classes = [];

        if (is_array($field->getValidation())) {
            foreach ($field->getValidation() as $key => $value) {
                if (is_array($value) && isset($value['class'])) {
                    $classes[$value['class']] = [];

                    if (isset($value['attributes'])) {
                        $classes[$value['class']] = $value['attributes'];
                    }
                }
            }
        }

        return $classes;
    }


    private function getSubValue(FormResult $formResult, $field_id)
    {
        $subValue = null;

        foreach ($formResult->getObjects() as $object) {
            foreach ($object->getValues() as $value) {
                if ($value->getField()->getId() === $field_id) {
                    $subValue = $value->getValue();

                    break;
                }
            }
        }

        return $subValue;
    }


    private function makeValidationClassError(ValidationClass $validationClass, FormField $formField, $value)
    {
        return [
            'field'   => [
                'title' => $formField->getTitle(),
                'id'    => $formField->getId(),
                'alias' => $formField->getAlias()
            ],
            'value'   => $value,
            'message' => $validationClass->getValidationErrorMessage()
        ];
    }


    private function checkForTypeAffilation(FormField $formField, $value)
    {
        $type = $formField->getType();

        return true;
        switch ($type) {
            case 'object':
                return Uuid::isValid($value) || empty($value);
                break;

            case 'string':
            case 'array':
                return is_string($value);

                break;

            case 'integer':
                return is_numeric($value) || empty($value);

                break;

            case 'float':
                return is_numeric($value) || empty($value);

                break;

            case 'date':
                if (empty($value)) {
                    return true;
                }

                $date = new \DateTime($value);

                if ($date) {
                    return true;
                } else {
                    return false;
                }

                break;

            case 'map':
            case 'file':
            case 'boolean':
                return true;

                break;

            default:

                return false;

                break;
        }
    }


    private function makeFieldTypeError(FormField $formField, $value)
    {
        return [
            'field'   => [
                'title' => $formField->getTitle(),
                'id'    => $formField->getId(),
                'alias' => $formField->getAlias()
            ],
            'value'   => $value,
            'message' => 'Несоответствие типов данных. Ожидался ' . $formField->getType() . '.'
        ];
    }


    private function makeErrorResult($errors)
    {
        return [
            'success' => false,
            'message' => 'Произошла ошибка валидации',
            'errors'  => $errors
        ];
    }


    private function makeSuccessResult()
    {
        return true;
    }


    public function validate(FormResult $formResult)
    {
        $errorsArray = [];

        foreach ($formResult->getObjects() as $object) {
            foreach ($object->getValues() as $formResultValue) {
                $formField = $formResultValue->getField();

                $isValidType = $this->checkForTypeAffilation($formField, $formResultValue->getValue());

                if ( ! $isValidType) {
                    $errorsArray[$formField->getFullAliasPath()][] = $this->makeFieldTypeError($formField, $formResultValue->getValue());
                }

                $classes = $this->getFieldValidationClasses($formField);

                foreach ($classes as $class => $attributes) {
                    $validationClass = $this->validationClassManager->get($class);

                    if ( ! $validationClass) {
                        continue;
                    }

                    if ($validationClass->requiredSubValue()) {
                        $checkResult = $validationClass->enforce(
                            $formField,
                            $formResultValue->getValue(),
                            $attributes,
                            $this->getSubValue($formResult, $attributes[$validationClass->getSubValueAttributeName()])
                        );
                    } else {
                        $checkResult = $validationClass->enforce(
                            $formField,
                            $formResultValue->getValue(),
                            $attributes,
                            null
                        );
                    }

                    if ( ! $checkResult) {
                        $errorsArray[$formField->getFullAliasPath()][] = $this->makeValidationClassError($validationClass, $formField, $formResultValue->getValue());
                    }
                }
            }
        }

        if ( ! empty($errorsArray)) {
            return $this->makeErrorResult($errorsArray);
        } else {
            return $this->makeSuccessResult();
        }
    }

}