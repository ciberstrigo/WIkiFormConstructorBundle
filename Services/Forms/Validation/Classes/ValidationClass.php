<?php

namespace WikiFormConstructorBundle\Services\Forms\Validation\Classes;

use WikiFormConstructorBundle\Entity\Objects\Form\FormField;

interface ValidationClass
{

    public function getClass(): string;


    public function getAllowedSettingsOptions(): array;


    public function getAllowedSubtypes(): array;


    public function enforce(FormField $formField, $value, $attributes = [], $subvalue = null): bool;


    public function requiredSubValue(): bool;


    public function getSubValueAttributeName(): string;


    public function getValidationErrorMessage(): string;
}