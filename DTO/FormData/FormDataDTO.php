<?php

namespace WikiFormConstructorBundle\DTO\FormData;

use WikiFormConstructorBundle\Entity\Objects\Form\Form;
use Symfony\Component\Serializer\Annotation\Groups;

class FormDataDTO
{

    /**
     * @var Form
     * @Groups({"forms_detail"})
     */
    private $data;

    /**
     * @var array
     * @Groups({"forms_detail"})
     */
    private $relations;

    /**
     * @var array
     * @Groups({"forms_detail"})
     */
    private $values;

    /**
     * @var array
     * @Groups({"forms_detail"})
     */
    private $formatting;

    /**
     * @var string
     * @Groups({"forms_detail"})
     */
    private $version;

    /**
     * @var \DateTime
     * @Groups({"forms_detail"})
     *
     */
    private $created_at;


    public function __construct()
    {
        $this->relations  = [];
        $this->values     = [];
        $this->formatting = [];
        $this->version    = '0';
    }


    /**
     * @param Form $data
     */
    public function setData(Form $data): void
    {
        $this->data = $data;
    }


    /**
     * @param mixed $values
     */
    public function setValues($values): void
    {
        $this->values = $values;
    }


    /**
     * @param mixed $formatting
     */
    public function setFormatting($formatting): void
    {
        $this->formatting = $formatting;
    }


    /**
     * @param mixed $relations
     */
    public function setRelations($relations): void
    {
        $this->relations = $relations;
    }


    /**
     * @param mixed $version
     */
    public function setVersion($version): void
    {
        $this->version = $version;
    }


    /**
     * @return mixed
     */
    public function getValues()
    {
        return $this->values;
    }


    /**
     * @return Form
     */
    public function getData()
    {
        return $this->data;
    }


    /**
     * @return mixed
     */
    public function getFormatting()
    {
        return $this->formatting;
    }


    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }


    /**
     * @param \DateTime $created_at
     */
    public function setCreatedAt($created_at): void
    {
        $this->created_at = $created_at;
    }


    /**
     * @return mixed
     */
    public function getRelations()
    {
        return $this->relations;
    }


    /**
     * @return mixed
     */
    public function getVersion()
    {
        return $this->version;
    }

}