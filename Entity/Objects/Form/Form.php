<?php

namespace WikiFormConstructorBundle\Entity\Objects\Form;

use Doctrine\ORM\Mapping\MappedSuperclass;
use WikiFormConstructorBundle\Entity\Objects\Form\Interfaces\HasAlias;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class Form
 * @MappedSuperclass
 * @package WikiFormConstructorBundle\Entity\SemanticObjects\Form
 * @ORM\Entity(repositoryClass="WikiFormConstructorBundle\Repository\DataObject\ObjectFormRepository")
 * @ORM\Table(name="forms")
 * @ORM\HasLifecycleCallbacks()
 */
class Form implements HasAlias
{

    /**
     * @var string
     *
     * @ORM\Id
     * @ORM\Column(type="string")
     * @Groups({"page_detail", "forms_detail", "forms_list", "object_types_detail", "permission_entity_list"})
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @Groups({"page_detail", "forms_detail"})
     */
    private $sort;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     * @Groups({"page_detail", "forms_detail", "forms_list", "object_types_detail", "permission_entity_list"})
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     * @Groups({"page_detail", "forms_detail", "forms_list", "object_types_detail"})
     */
    private $alias;

    /**
     * @ORM\Column(type="json")
     * @Groups({"page_detail", "forms_detail"})
     */
    private $attributes;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     * @Groups({"forms_detail", "forms_list", "object_types_detail"})
     */
    private $version;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     * @Groups({"forms_detail"})
     * @Attribute(title="Является публичной", type="boolean")
     */
    private $public;

    /**
     * @var array
     *
     * @ORM\Column(type="json")
     */
    private $transition_logic;

    /**
     * @var FormObject[]
     *
     * @Groups({"forms_detail"})
     * @ORM\OneToMany(targetEntity="WikiFormConstructorBundle\Entity\Objects\Form\FormObject", mappedBy="form", cascade={"all"})
     */
    private $objects;

    /**
     * @var FormObjectRelation[]
     *
     * @ORM\OneToMany(targetEntity="WikiFormConstructorBundle\Entity\Objects\Form\FormObjectRelation", mappedBy="form", cascade={"all"}, orphanRemoval=true)
     */
    private $relations;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"page_detail", "forms_detail", "forms_list"})
     */
    private $created_at;

    /**
     * @var FormStep[]
     *
     * @ORM\OneToMany(targetEntity="WikiFormConstructorBundle\Entity\Objects\Form\FormStep", mappedBy="form", cascade={"all"}, orphanRemoval=true)
     * @ORM\OrderBy({"sort" = "ASC"})
     */
    private $steps;

    /**
     * @var FormResult[]
     *
     * @ORM\OneToMany(targetEntity="WikiFormConstructorBundle\Entity\Objects\Form\FormResult", mappedBy="form")
     */
    private $results;


    public function __construct()
    {
        $this->id        = (string)Uuid::uuid4();
        $this->objects   = new ArrayCollection();
        $this->relations = new ArrayCollection();
        $this->results   = new ArrayCollection();
        $this->steps     = new ArrayCollection();

        $this->public = false;
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
     * @return string
     */
    public function getAlias(): string
    {
        return $this->alias;
    }


    /**
     * @return bool
     */
    public function isPublic(): bool
    {
        return $this->public;
    }


    /**
     * @param bool $public
     */
    public function setPublic(bool $public): void
    {
        $this->public = $public;
    }


    /**
     * @return \DateTime|false|string
     */
    public function getCreatedAt()
    {
        if ($this->created_at instanceof \DateTimeInterface) {
            return \date_format($this->created_at, 'd.m.Y H:i:s');
        } else {
            return $this->created_at;
        }
    }


    /**
     * @param \DateTime $created_at
     */
    public function setCreatedAt($created_at): void
    {
        $this->created_at = $created_at;
    }


    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }


    /**
     * @return mixed
     */
    public function getAttributes()
    {
        return $this->attributes;
    }


    /**
     * @param mixed $attributes
     */
    public function setAttributes($attributes): void
    {
        $this->attributes = $attributes;
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
     * @return array
     */
    public function getTransitionLogic()
    {
        return $this->transition_logic;
    }


    /**
     * @return FormResult[]
     */
    public function getResults()
    {
        return $this->results;
    }


    /**
     * @param FormResult[] $results
     */
    public function setResults($results): void
    {
        $this->results = $results;
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
     * @param string $alias
     */
    public function setAlias(string $alias): void
    {
        $this->alias = $alias;
    }


    /**
     * @param int $sort
     */
    public function setSort(int $sort): void
    {
        $this->sort = $sort;
    }


    /**
     * @return null|string
     */
    public function getVersion(): ?string
    {
        return $this->version;
    }


    /**
     * @return FormObject[]
     */
    public function getObjects()
    {
        return $this->objects;
    }


    /**
     * @param FormObject[] $objects
     */
    public function setObjects($objects): void
    {
        $this->objects = $objects;
    }


    /**
     * @return FormObjectRelation[]
     */
    public function getRelations()
    {
        return $this->relations;
    }


    /**
     * @param mixed $transition_logic
     */
    public function setTransitionLogic($transition_logic): void
    {
        $this->transition_logic = $transition_logic;
    }


    /**
     * @param FormObjectRelation[] $relations
     */
    public function setRelations($relations): void
    {
        $this->relations = $relations;
    }


    public function getFullAliasPath(): string
    {
        return $this->getAlias();
    }


    /**
     * @return FormStep[]
     */
    public function getSteps()
    {
        return $this->steps;
    }


    /**
     * @param FormStep[] $steps
     */
    public function setSteps($steps): void
    {
        $this->steps = $steps;
    }


    /**
     * @param null|string $version
     */
    public function setVersion(?string $version): void
    {
        $this->version = $version;
    }


    public function addObject(FormObject $object)
    {
        if ( ! $this->objects->contains($object)) {
            $object->setForm($this);
            $this->objects->add($object);
        }
    }


    public function removeObject(FormObject $object)
    {
        $object->setForm(null);

        $this->objects->removeElement($object);
    }


    public function getGuid()
    {
        return $this->id;
    }


    public static function getSecurableType()
    {
        return 'form';
    }


    public static function getAuditResultClass()
    {
        return AuditResult::class;
    }
}
