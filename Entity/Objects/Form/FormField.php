<?php

namespace WikiFormConstructorBundle\Entity\Objects\Form;

use Doctrine\ORM\Mapping\MappedSuperclass;
use WikiFormConstructorBundle\Entity\Objects\Form\Interfaces\HasAlias;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class SemanticObjectFormField
 * @MappedSuperclass
 * @package WikiFormConstructorBundle\Entity\SemanticObjects\Form
 * @ORM\Entity()
 * @ORM\Table(name="forms_objects_fields")
 */
class FormField implements HasAlias
{

    /**
     * @var string
     *
     * @ORM\Id
     * @ORM\Column(type="string", nullable=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="WikiFormConstructorBundle\Doctrine\Generator\UuidGenerator")
     * @Groups({"forms_result_detail", "forms_detail"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     * @Groups({"forms_result_detail", "forms_detail"})
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     * @Groups({"forms_detail"})
     */
    private $alias;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     * @Groups({"forms_detail"})
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     * @Groups({"forms_detail"})
     */
    private $subtype;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", nullable=true)
     * @Groups({"forms_detail"})
     */
    private $multiple;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", name="read_only", nullable=true)
     * @Groups({"forms_detail"})
     */
    private $readOnly;

    /**
     * @var null|array
     *
     * @ORM\Column(type="json", nullable=true)
     * @Groups({"forms_detail"})
     */
    private $validation;

    /**
     * @var null|array
     *
     * @ORM\Column(type="json", nullable=true)
     * @Groups({"forms_detail"})
     */
    private $settings;

    /**
     * @var null|string
     *
     * @ORM\Column(type="string", nullable=true)
     * @Groups({"forms_detail"})
     */
    private $default_value;

    /**
     * @var null|FormObject
     *
     * @ORM\ManyToOne(targetEntity="WikiFormConstructorBundle\Entity\Objects\Form\FormObject", inversedBy="fields")
     * @ORM\JoinColumn(name="forms_object_id", referencedColumnName="id")
     */
    private $form_object;

    /**
     * @var null|string
     *
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"forms_detail"})
     */
    private $linkedField;


    public function __construct()
    {
        $this->id       = (string)Uuid::uuid4();
        $this->multiple = false;
        $this->readOnly = false;
    }


    /**
     * @return string|null
     */
    public function getLinkedField(): ?string
    {
        return $this->linkedField;
    }


    /**
     * @param string|null $linkedField
     */
    public function setLinkedField(?string $linkedField): void
    {
        $this->linkedField = $linkedField;
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
    public function getAlias(): ?string
    {
        return $this->alias;
    }


    /**
     * @return string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }


    /**
     * @return string
     */
    public function getType(): ?string
    {
        return $this->type;
    }


    /**
     * @return string
     */
    public function getSubtype(): ?string
    {
        return $this->subtype;
    }


    /**
     * @return array|null
     */
    public function getSettings(): ?array
    {
        return $this->settings;
    }


    /**
     * @return array|null
     */
    public function getValidation(): ?array
    {
        return $this->validation;
    }


    /**
     * @return bool
     */
    public function isReadOnly(): bool
    {
        return $this->readOnly;
    }


    /**
     * @param bool $readOnly
     */
    public function setReadOnly(bool $readOnly): void
    {
        $this->readOnly = $readOnly;
    }


    /**
     * @return null|string
     */
    public function getDefaultValue(): ?string
    {
        return $this->default_value;
    }


    /**
     * @return FormObject|null
     */
    public function getFormObject(): ?FormObject
    {
        return $this->form_object;
    }


    /**
     * @param string $id
     */
    public function setId(?string $id): void
    {
        $this->id = $id;
    }


    /**
     * @param ?string $alias
     */
    public function setAlias(?string $alias): void
    {
        $this->alias = $alias;
    }


    /**
     * @param ?string $title
     */
    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }


    /**
     * @param ?string $type
     */
    public function setType(?string $type): void
    {
        $this->type = $type;
    }


    /**
     * @param bool $multiple
     */
    public function setMultiple(bool $multiple): void
    {
        $this->multiple = $multiple;
    }


    /**
     * @param string $subtype
     */
    public function setSubtype(?string $subtype): void
    {
        $this->subtype = $subtype;
    }


    /**
     * @param array|null $settings
     */
    public function setSettings(?array $settings): void
    {
        $this->settings = $settings;
    }


    /**
     * @param null|string $default_value
     */
    public function setDefaultValue(?string $default_value): void
    {
        $this->default_value = $default_value;
    }


    /**
     * @param array|null $validation
     */
    public function setValidation(?array $validation): void
    {
        $this->validation = $validation;
    }


    /**
     * @param FormObject|null $form_object
     */
    public function setFormObject(?FormObject $form_object): void
    {
        $this->form_object = $form_object;
    }


    /**
     * @return bool
     */
    public function isMultiple(): bool
    {
        return $this->multiple;
    }


    public function getFullAliasPath(): string
    {
        if ( ! $this->form_object) {
            return $this->getAlias();
        }

        $formObjectAlias = $this->form_object->getFullAliasPath();

        return $formObjectAlias . '/' . $this->getAlias();
    }

}