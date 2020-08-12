<?php

namespace WikiFormConstructorBundle\Entity\Objects\Form;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\MappedSuperclass;
use Ramsey\Uuid\Uuid;

/**
 * Class FormObjectRelation
 * @MappedSuperclass
 * @package WikiFormConstructorBundle\Entity\Objects\Form\Relations
 * @ORM\Entity()
 * @ORM\Table(name="forms_objects_relations")
 */
class FormObjectRelation
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var FormField
     *
     * @ORM\OneToOne(targetEntity="WikiFormConstructorBundle\Entity\Objects\Form\FormField")
     * @ORM\JoinColumn(name="subject_id", referencedColumnName="id")
     */
    private $subject;

    /**
     * @var FormObject
     *
     * @ORM\OneToOne(targetEntity="WikiFormConstructorBundle\Entity\Objects\Form\FormObject")
     * @ORM\JoinColumn(name="object_id", referencedColumnName="id")
     */
    private $object;

    /**
     * @var Form
     *
     * @ORM\ManyToOne(targetEntity="WikiFormConstructorBundle\Entity\Objects\Form\Form", inversedBy="relations")
     */
    private $form;


    public function __construct()
    {
        $this->id = (string)Uuid::uuid4();
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @return Form
     */
    public function getForm(): Form
    {
        return $this->form;
    }


    /**
     * @return FormField
     */
    public function getSubject(): FormField
    {
        return $this->subject;
    }


    /**
     * @return FormObject
     */
    public function getObject(): FormObject
    {
        return $this->object;
    }


    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }


    /**
     * @param Form $form
     */
    public function setForm(Form $form): void
    {
        $this->form = $form;
    }


    /**
     * @param FormField $subject
     */
    public function setSubject(FormField $subject): void
    {
        $this->subject = $subject;
    }


    /**
     * @param FormObject $object
     */
    public function setObject(FormObject $object): void
    {
        $this->object = $object;
    }

}