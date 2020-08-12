<?php

namespace WikiFormConstructorBundle\Services\Forms\Validation;

use WikiFormConstructorBundle\Services\Forms\Validation\Classes\ValidationClass;
use Doctrine\Common\Collections\ArrayCollection;

class ValidationClassManager
{

    /**
     * @var ValidationClass[]
     */
    private $validationClasses;


    public function __construct()
    {
        $this->validationClasses = new ArrayCollection();
    }


    public function addValidationClass(ValidationClass $class)
    {
        if ( ! $this->validationClasses->contains($class)) {
            $this->validationClasses->add($class);
        }
    }


    public function getValidationClasses()
    {
        return $this->validationClasses;
    }


    public function get($classKey)
    {
        foreach ($this->validationClasses as $validationClass) {
            if ($validationClass->getClass() === $classKey) {
                return $validationClass;
            }
        }

        return null;
    }
}