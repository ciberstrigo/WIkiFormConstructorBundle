<?php

namespace WikiFormConstructorBundle\Repository\DataObject;

use Doctrine\ORM\EntityRepository;

class ObjectTypeRepository extends EntityRepository
{

    public function findAll()
    {
        return $this->findBy([], [ 'title' => 'ASC' ]);
    }


    public function getObjectsWithForm()
    {
        $qb = $this->createQueryBuilder('o');

        $data = $qb->select('o')
                   ->where(
                       $qb->expr()->isNotNull('o.defaultForm')
                   );

        return $data->getQuery()->execute();

    }


    public function getAllQueryBuilder()
    {
        $qb = $this->createQueryBuilder('object_type')
                   ->orderBy('object_type.title', 'ASC');

        return $qb->select('object_type');
    }


    public function getPublicTypes()
    {
        $qb = $this->createQueryBuilder('o');

        $data = $qb->select('o')
                   ->andWhere(
                       $qb->expr()->isNotNull('o.defaultForm'),
                       'o.public = TRUE'
                   )
                   ->orderBy('o.title', 'ASC');

        return $data->getQuery()->execute();
    }
}