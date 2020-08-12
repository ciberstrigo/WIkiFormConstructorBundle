<?php

namespace WikiFormConstructorBundle\Entity\Objects\Form;

//use WikiFormConstructorBundle\Entity\Objects\DataObject;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\MappedSuperclass;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;

/**
 * Class FormResultObject
 * @MappedSuperclass
 * @package WikiFormConstructorBundle\Entity\Objects\Form
 *
 * @ORM\Entity()
 * @ORM\Table(name="forms_results_objects")
 */
class FormResultObject
{

    /**
     * @var string
     *
     * @ORM\Id()
     * @ORM\Column(type="string")
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     * @Groups({"forms_result_detail"})
     *
     */
    private $id;

    /**
     * @var FormObject
     *
     * @ORM\ManyToOne(targetEntity="WikiFormConstructorBundle\Entity\Objects\Form\FormObject")
     * @ORM\JoinColumn(name="form_object_id", referencedColumnName="id")
     */
    private $formObject;

    /**
     * @var FormResult
     *
     * @ORM\ManyToOne(targetEntity="WikiFormConstructorBundle\Entity\Objects\Form\FormResult", inversedBy="objects")
     * @ORM\JoinColumn(name="form_result_id", referencedColumnName="id")
     */
    private $formResult;

    /**
     * @var FormResultObject
     *
     * @ORM\ManyToOne(targetEntity="WikiFormConstructorBundle\Entity\Objects\Form\FormResultObject", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     * @Groups({"forms_result_detail"})
     * @MaxDepth(1)
     */
    private $parent;

    /**
     * @var FormResultValue[]
     *
     * @ORM\OneToMany(targetEntity="FormResultValue", mappedBy="resultObject", cascade={"persist"})
     * @Groups({"forms_result_detail"})
     */
    private $values;

    /**
     * @var FormResultObject[]
     *
     * @ORM\OneToMany(targetEntity="WikiFormConstructorBundle\Entity\Objects\Form\FormResultObject", mappedBy="parent")
     */
    private $children;

    /**
     * @var integer
     *
     * @ORM\Column()
     * @Groups({"forms_result_detail"})
     */
    private $sort;


    public function __construct()
    {
        $this->id = (string)Uuid::uuid4();

        $this->sort     = 0;
        $this->values   = new ArrayCollection();
        $this->children = new ArrayCollection();
    }


    /**
     * @param int $sort
     */
    public function setSort(int $sort): void
    {
        $this->sort = $sort;
    }


    /**
     * @return int
     */
    public function getSort(): int
    {
        return $this->sort;
    }


    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }


    /**
     * @return FormResult
     */
    public function getFormResult(): FormResult
    {
        return $this->formResult;
    }


    /**
     * @return FormResultValue[]
     */
    public function getValues()
    {
        return $this->values;
    }


    /**
     * @param FormResultValue[] $values
     */
    public function setValues($values): void
    {
        $this->values = $values;
    }


    public function addValue(FormResultValue $value)
    {
        $value->setResultObject($this);

        $this->values->add($value);
    }


    public function removeValue(FormResultValue $value)
    {
        $this->values->removeElement($value);
    }


    /**
     * @return FormObject
     */
    public function getFormObject(): FormObject
    {
        return $this->formObject;
    }


    /**
     * @return FormResultObject
     */
    public function getParent(): ?FormResultObject
    {
        return $this->parent;
    }


    /**
     * @return FormResultObject[]
     */
    public function getChildren()
    {
        return $this->children;
    }


    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }


    /**
     * @param FormResult $formResult
     */
    public function setFormResult(FormResult $formResult): void
    {
        $this->formResult = $formResult;
    }


    /**
     * @param FormResultObject $parent
     */
    public function setParent(?FormResultObject $parent): void
    {
        $this->parent = $parent;
    }


    /**
     * @param FormResultObject[] $children
     */
    public function setChildren($children): void
    {
        $this->children = $children;
    }


    /**
     * @param FormObject $formObject
     */
    public function setFormObject(FormObject $formObject): void
    {
        $this->formObject = $formObject;
    }


    public function addChildren(FormResultObject $children)
    {
        $children->setParent($this);

        $this->children->add($children);
    }


    public function removeChildren(FormResultObject $children)
    {
        $this->children->removeElement($children);
    }
}