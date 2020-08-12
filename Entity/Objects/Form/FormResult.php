<?php

namespace WikiFormConstructorBundle\Entity\Objects\Form;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\MappedSuperclass;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class FormResult
 * @MappedSuperclass
 * @package WikiFormConstructorBundle\Entity\Objects\Form
 *
 * @ORM\Entity()
 * @ORM\Table(name="forms_results")
 * @ORM\HasLifecycleCallbacks
 *
 */
class FormResult
{

    /**
     * @var string
     *
     * @ORM\Id
     * @ORM\Column(type="string")
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="WikiFormConstructorBundle\Doctrine\Generator\UuidGenerator")
     * @Groups({"page_detail", "forms_result_detail", "forms_result_list"})
     *
     */
    private $id;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"page_detail", "forms_result_detail", "forms_result_list"})
     */
    private $updatedAt;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"page_detail", "forms_result_detail", "forms_result_list"})
     */
    private $createdAt;

    /**
     * @var Form
     *
     * @ORM\ManyToOne(targetEntity="Form", inversedBy="results")
     * @ORM\JoinColumn(name="form_id", referencedColumnName="id")
     */
    private $form;

    /**
     *
     * @var FormResultObject[]
     *
     * @ORM\OneToMany(targetEntity="FormResultObject", mappedBy="formResult", cascade={"persist"})
     * @Groups({"page_detail", "forms_result_detail"})
     */
    private $objects;


    public function __construct()
    {
        $this->id              = (string)Uuid::uuid4();
        $this->objects         = new ArrayCollection();

    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updatedTimestamps(): void
    {
        $this->setUpdatedAt(new \DateTime('now'));
        if ($this->getCreatedAt() === null) {
            $this->setCreatedAt(new \DateTime('now'));
        }
    }


    /**
     * @param \DateTime $updated_at
     */
    public function setUpdatedAt(\DateTime $updated_at): void
    {
        $this->updatedAt = $updated_at;
    }


    /**
     * @param string $id
     */
    public function setId(string $id): void
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
     * @param \DateTime $created_at
     */
    public function setCreatedAt(\DateTime $created_at): void
    {
        $this->createdAt = $created_at;
    }


    /**
     * @return Form
     */
    public function getForm(): Form
    {
        return $this->form;
    }


    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }


    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }


    /**
     * @return \DateTime
     */
    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }


    /**
     * @return FormResultObject[]
     */
    public function getObjects()
    {
        return $this->objects;
    }


    /**
     * @param FormResultObject[] $objects
     */
    public function setObjects($objects): void
    {
        $this->objects = $objects;
    }


    public function addObject(FormResultObject $object)
    {
        $object->setFormResult($this);

        if ( ! $this->objects->contains($object)) {
            $this->objects->add($object);
        }
    }


    public function removeObject(FormResultObject $object)
    {
        $this->objects->removeElement($object);
    }

}