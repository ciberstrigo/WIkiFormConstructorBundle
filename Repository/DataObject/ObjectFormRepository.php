<?php

namespace WikiFormConstructorBundle\Repository\DataObject;

use WikiFormConstructorBundle\Entity\Objects\Form\Form;
use Doctrine\ORM\EntityRepository;

class ObjectFormRepository extends EntityRepository
{

    public function getAllQueryBuilder()
    {
        $qb = $this->createQueryBuilder('form');

        return $qb->select('form')->orderBy('form.title', 'ASC');
    }


    public function getGroupedForms()
    {
        $qb = $this->createQueryBuilder('f');

        $data = $qb->select('f')
                   ->where('f.created_at = (SELECT MAX(form.created_at) FROM ' . Form::class . ' form WHERE form.alias = f.alias)');

        $forms = $data->getQuery()->execute();

        return $forms;
    }


    public function findLastForm($alias)
    {
        $qb = $this->createQueryBuilder('f');

        $data = $qb->select('f')
                   ->where('f.created_at = (SELECT MAX(form.created_at) FROM ' . Form::class . ' form WHERE form.alias = f.alias)')
                   ->andWhere($qb->expr()->eq('f.alias', ':al'))
                   ->setParameter('al', $alias);

        $form = $data->getQuery()->getOneOrNullResult();

        return $form;
    }

}