<?php

namespace WikiFormConstructorBundle\Entity\Objects\Form\Interfaces;

interface HasAlias
{
    public function getFullAliasPath(): string;
}