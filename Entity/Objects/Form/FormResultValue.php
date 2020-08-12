<?php

namespace WikiFormConstructorBundle\Entity\Objects\Form;

//use WikiFormConstructorBundle\Entity\Objects\ObjectValue;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\MappedSuperclass;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class FormResultValue
 * @MappedSuperclass
 * @package WikiFormConstructorBundle\Entity\Objects\Form
 * @ORM\Entity()
 * @ORM\Table(name="forms_results_values")
 */
class FormResultValue
{

    /**
     * @var string
     *
     * @ORM\Id
     * @ORM\Column(type="string")
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="WikiFormConstructorBundle\Doctrine\Generator\UuidGenerator")
     * @Groups({"forms_result_detail"})
     */
    private $id;

    /**
     * @var mixed
     *
     * @ORM\Column()
     * @Groups({"forms_result_detail"})
     */
    private $value;

    /**
     * @var FormResultObject
     *
     * @ORM\ManyToOne(targetEntity="FormResultObject", inversedBy="values", cascade={"persist"})
     * @ORM\JoinColumn(name="form_result_object_id", referencedColumnName="id")
     */
    private $resultObject;

    /**
     * @var FormField
     *
     * @ORM\ManyToOne(targetEntity="FormField")
     * @ORM\JoinColumn(name="form_field_id", referencedColumnName="id")
     * @Groups({"forms_result_detail"})
     */
    private $field;

//    /**
//     * @var null|ObjectValue
//     *
//     * @ORM\ManyToOne(targetEntity="WikiFormConstructorBundle\Entity\Objects\ObjectValue")
//     * @ORM\JoinColumn(name="created_object_field_value_id", referencedColumnName="id")
//     */
//    private $createdObjectValue;

    /**
     * @var FormResult
     *
     * @ORM\ManyToOne(targetEntity="FormResult")
     * @ORM\JoinColumn(name="linked_form_result_id", referencedColumnName="id")
     */
    private $linked_form_result;


    public function __construct()
    {
        $this->id = (string)Uuid::uuid4();
    }


    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }


    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }


    /**
     * @return FormField
     */
    public function getField(): ?FormField
    {
        return $this->field;
    }


    /**
     * @return FormResultObject
     */
    public function getResultObject(): ?FormResultObject
    {
        return $this->resultObject;
    }


    /**
     * @return FormResult
     */
    public function getLinkedFormResult(): ?FormResult
    {
        return $this->linked_form_result;
    }


//    /**
//     * @return ObjectValue|null
//     */
//    public function getCreatedObjectValue(): ?ObjectValue
//    {
//        return $this->createdObjectValue;
//    }
//
//
//    /**
//     * @param ObjectValue|null $createdObjectValue
//     */
//    public function setCreatedObjectValue(?ObjectValue $createdObjectValue): void
//    {
//        $this->createdObjectValue = $createdObjectValue;
//    }


    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }


    /**
     * @param mixed $value
     */
    public function setValue($value): void
    {
        $this->value = $value;
    }


    /**
     * @param FormResultObject $resultObject
     */
    public function setResultObject(FormResultObject $resultObject): void
    {
        $this->resultObject = $resultObject;
    }


    /**
     * @param FormField $field
     */
    public function setField(FormField $field): void
    {
        $this->field = $field;
    }


    /**
     * @param FormResult $linked_form_result
     */
    public function setLinkedFormResult(FormResult $linked_form_result): void
    {
        $this->linked_form_result = $linked_form_result;
    }

}