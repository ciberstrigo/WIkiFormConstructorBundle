<?php

namespace WikiFormConstructorBundle\DTO\FormData;

use WikiFormConstructorBundle\Entity\Objects\Form\Form;
use WikiFormConstructorBundle\Entity\Objects\Form\FormResult;

class FormDataResultDTO
{

    private $values;

    /** @var FormResult */
    private $formResult;

    /** @var Form */
    private $form;


    /**
     * @param mixed $values
     */
    public function setValues($values): void
    {
        $this->values = $values;
    }


    /**
     * @param mixed $formResult
     */
    public function setFormResult($formResult): void
    {
        $this->formResult = $formResult;
    }


    /**
     * @return mixed
     */
    public function getValues()
    {
        return $this->values;
    }


    /**
     * @return FormResult
     */
    public function getFormResult()
    {
        return $this->formResult;
    }


    /**
     * @return Form
     */
    public function getForm()
    {
        return $this->form;
    }


    /**
     * @param mixed $form
     */
    public function setForm($form): void
    {
        $this->form = $form;
    }

}