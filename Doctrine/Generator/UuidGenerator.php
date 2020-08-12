<?php

namespace WikiFormConstructorBundle\Doctrine\Generator;

use Doctrine\ORM\EntityManager;
use Ramsey\Uuid\Doctrine\UuidGenerator as BaseUuidGenerator;
use Ramsey\Uuid\Uuid;

class UuidGenerator extends BaseUuidGenerator
{
    /**
     * {@inheritdoc}
     */
    public function generate(EntityManager $em, $entity)
    {
        /** @var Uuid $uuid */
        $uuid = parent::generate($em, $entity);

        return $uuid->toString();
    }
}