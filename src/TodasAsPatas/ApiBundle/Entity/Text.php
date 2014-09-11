<?php

namespace TodasAsPatas\ApiBundle\Entity;

use DateTime;
use TodasAsPatas\ApiBundle\Enum\TextType;
use TodasAsPatas\ApiBundle\Enum\TextTypeEnum;

/**
 * Text
 */
class Text
{

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $content;

    /**
     * @var integer
     */
    private $typeId;

    /**
     * @var DateTime
     */
    private $createdAt;

    /**
     * @var DateTime
     */
    private $updatedAt;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Text
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Text
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set typeId
     *
     * @param integer $typeId
     * @return Text
     */
    public function setTypeId($typeId)
    {
        $this->typeId = $typeId;

        return $this;
    }

    /**
     * Set Type
     *  
     * @param TextType $type
     * 
     * @return Text
     */
    public function setType(TextType $type)
    {
        return $this->setTypeId($type->getId());
    }

    /**
     * Get typeId
     *
     * @return integer 
     */
    public function getTypeId()
    {
        return $this->typeId;
    }

    /**
     * Get Type
     *
     * @return TextType
     */
    public function getType()
    {
        return TextTypeEnum::getInstance()->getItem($this->getTypeId());
    }

    /**
     * Set createdAt
     *
     * @param DateTime $createdAt
     * @return Text
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param DateTime $updatedAt
     * @return Text
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

}
