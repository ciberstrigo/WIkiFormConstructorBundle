<?php

namespace WikiFormConstructorBundle\Entity\Objects\Form;

use Doctrine\ORM\Mapping\MappedSuperclass;
use WikiFormConstructorBundle\Entity\Objects\Form\Interfaces\HasAlias;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class FormObject
 * @MappedSuperclass
 * @package WikiFormConstructorBundle\Entity\Objects\Form
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="forms_objects")
 */
class FormObject implements HasAlias
{

    /**
     * @var string
     *
     * @ORM\Id
     * @ORM\Column(type="string")
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="WikiFormConstructorBundle\Doctrine\Generator\UuidGenerator")
     * @Groups({"forms_detail"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     * @Groups({"forms_detail"})
     */
    private $alias;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     * @Groups({"forms_detail"})
     */
    private $title;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     * @Groups({"forms_detail"})
     */
    private $multiple;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     */
    private $uploadable;

    /**
     * @var null|array
     *
     * @ORM\Column(type="json")
     * @Groups({"forms_detail"})
     *
     */
    private $semantic_subclasses;

    /**
     * @var null|string
     * @ORM\Column(type="string", nullable=true)
     * @Groups({"forms_detail"})
     */
    private $mask;

    /**
     * @var null|\DateTime
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"forms_detail"})
     */
    private $updated_at;

    /**
     * @var null|\DateTime
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"forms_detail"})
     */
    private $created_at;

    /**
     * @var null|Form
     *
     * @ORM\ManyToOne(targetEntity="WikiFormConstructorBundle\Entity\Objects\Form\Form", inversedBy="objects")
     */
    private $form;

//    /**
//     * @var null|ObjectType
//     *
//     * @ORM\ManyToOne(targetEntity="WikiFormConstructorBundle\Entity\Objects\ObjectType")
//     * @Groups({"forms_detail"})
//     */
//    private $object_type;

    /**
     * @var null|self
     *
     * @ORM\ManyToOne(targetEntity="WikiFormConstructorBundle\Entity\Objects\Form\FormObject")
     * @ORM\JoinColumn(name="parent_object_id", referencedColumnName="id")
     */
    private $parent;

    /**
     * @var FormField[]
     *
     * @ORM\OneToMany(targetEntity="FormField", mappedBy="form_object", cascade={"all"})
     * @Groups({"forms_detail"})
     */
    private $fields;


    public function __construct()
    {
        $this->id                  = (string)Uuid::uuid4();
        $this->multiple            = false;
        $this->uploadable          = false;
        $this->semantic_subclasses = [];
        $this->fields              = new ArrayCollection();
    }


    public function addField(FormField $formField)
    {
        if ( ! $this->fields->contains($formField)) {
            $formField->setFormObject($this);

            $this->fields->add($formField);
        }
    }


    public function removeField(FormField $formField)
    {
        $formField->setFormObject(null);

        $this->fields->removeElement($formField);
    }


    /**
     * @return string
     */
    public function getId(): ?string
    {
        return $this->id;
    }


    /**
     * @return string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }


    /**
     * @return null|string
     */
    public function getMask(): ?string
    {
        return $this->mask;
    }


    /**
     * @return FormObject
     */
    public function getParent(): ?FormObject
    {
        return $this->parent;
    }


//    /**
//     * @return ObjectType
//     */
//    public function getObjectType(): ?ObjectType
//    {
//        return $this->object_type;
//    }

    ///**
    // * @Serializer\VirtualProperty()
    // * @Serializer\SerializedName("object_type")
    // */
    //public function getObjectTypeId()
    //{
    //    return $this->object_type->getId();
    //}

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): ?\DateTime
    {
        return $this->created_at;
    }


    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updated_at;
    }


    /**
     * @return Form
     */
    public function getForm(): ?Form
    {
        return $this->form;
    }


    /**
     * @param null|string $mask
     */
    public function setMask(?string $mask): void
    {
        $this->mask = $mask;
    }


    /**
     * @return string
     */
    public function getAlias(): ?string
    {
        return $this->alias;
    }


    /**
     * @return array
     */
    public function getSemanticSubclasses(): ?array
    {
        return $this->semantic_subclasses;
    }


    /**
     * @return bool
     */
    public function isMultiple(): bool
    {
        return $this->multiple;
    }


    /**
     * @return FormField[]
     */
    public function getFields()
    {
        return $this->fields;
    }


    /**
     * @param FormField[] $fields
     */
    public function setFields($fields): void
    {
        $this->fields = $fields;
    }


    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }


    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }


    /**
     * @param null|FormObject $parent
     */
    public function setParent(?FormObject $parent): void
    {
        $this->parent = $parent;
    }


//    /**
//     * @param null|ObjectType $object_type
//     */
//    public function setObjectType(?ObjectType $object_type): void
//    {
//        $this->object_type = $object_type;
//    }


    /**
     * @param null|\DateTime $created_at
     */
    public function setCreatedAt(?\DateTime $created_at): void
    {
        $this->created_at = $created_at;
    }


    /**
     * @param Form $form
     */
    public function setForm(?Form $form): void
    {
        $this->form = $form;
    }


    /**
     * @param null|\DateTime $updated_at
     */
    public function setUpdatedAt(?\DateTime $updated_at): void
    {
        $this->updated_at = $updated_at;
    }


    /**
     * @param string $alias
     */
    public function setAlias(string $alias): void
    {
        $this->alias = $alias;
    }


    /**
     * @param bool $multiple
     */
    public function setMultiple(bool $multiple): void
    {
        $this->multiple = $multiple;
    }


    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updatedTimestamps(): void
    {
        if ($this->getCreatedAt() === null) {
            $this->setCreatedAt(new \DateTime('now'));
        }
    }


    /**
     * @param null|array $semantic_subclasses
     */
    public function setSemanticSubclasses(?array $semantic_subclasses): void
    {
        $this->semantic_subclasses = $semantic_subclasses;
    }


    public function getFullAliasPath(): string
    {
        $formAlias = $this->form->getAlias();

        return $formAlias . '/' . $this->getAlias();
    }
}