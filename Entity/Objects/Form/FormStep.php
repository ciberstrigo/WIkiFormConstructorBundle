<?php

namespace WikiFormConstructorBundle\Entity\Objects\Form;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\MappedSuperclass;

/**
 * Class FormFormatting
 * @MappedSuperclass
 * @package WikiFormConstructorBundle\Entity\Objects\Form
 *
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="forms_steps")
 */
class FormStep
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $alias;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     */
    private $sort;

    /**
     * @var array
     *
     * @ORM\Column(type="json")
     */
    private $formatting;

    /**
     * @var null|\DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @var Form
     *
     * @ORM\ManyToOne(targetEntity="WikiFormConstructorBundle\Entity\Objects\Form\Form", inversedBy="steps")
     */
    private $form;


    public function __construct()
    {
        $this->sort = 0;
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @return string
     */
    public function getAlias(): string
    {
        return $this->alias;
    }


    /**
     * @return int
     */
    public function getSort(): int
    {
        return $this->sort;
    }

    /**
     * @return array
     */
    public function getFormatting(): array
    {
        return $this->formatting;
    }


    /**
     * @return \DateTime|null
     */
    public function getCreatedAt(): ?\DateTime
    {
        return $this->created_at;
    }


    /**
     * @return Form
     */
    public function getForm(): Form
    {
        return $this->form;
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
     * @param int $sort
     */
    public function setSort(int $sort): void
    {
        $this->sort = $sort;
    }


    /**
     * @param string $alias
     */
    public function setAlias(string $alias): void
    {
        $this->alias = $alias;
    }


    /**
     * @param \DateTime|null $created_at
     */
    public function setCreatedAt(?\DateTime $created_at): void
    {
        $this->created_at = $created_at;
    }


    /**
     * @param array $formatting
     */
    public function setFormatting(array $formatting): void
    {
        $this->formatting = $formatting;
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

}