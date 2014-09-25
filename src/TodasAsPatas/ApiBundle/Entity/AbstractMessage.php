<?php

namespace TodasAsPatas\ApiBundle\Entity;

use DateTime;

/**
 * AbstractMessage
 */
abstract class AbstractMessage implements NotificationPrototypeInterface
{

    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $message;

    /**
     * @var string
     */
    protected $response;

    /**
     * @var DateTime
     */
    protected $createdAt;

    /**
     * @var DateTime
     */
    protected $updatedAt;

    /**
     * @var DateTime
     */
    protected $deletedAt;

    /**
     * @var Pet
     */
    protected $pet;

    /**
     * @var UserCommon
     */
    protected $user;

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
     * @return AbstractMessage
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
     * Set message
     *
     * @param string $message
     * @return AbstractMessage
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string 
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set response
     *
     * @param string $response
     * @return AbstractMessage
     */
    public function setResponse($response)
    {
        $this->response = $response;

        return $this;
    }

    /**
     * Get response
     *
     * @return string 
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Set createdAt
     *
     * @param DateTime $createdAt
     * @return AbstractMessage
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
     * @return AbstractMessage
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

    /**
     * Set deletedAt
     *
     * @param DateTime $deletedAt
     * @return AbstractMessage
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    /**
     * Get deletedAt
     *
     * @return DateTime 
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    /**
     * Set user
     *
     * @param UserCommon $user
     * @return AbstractMessage
     */
    public function setUser(UserCommon $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return UserCommon 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set pet
     *
     * @param Pet $pet
     * @return AbstractMessage
     */
    public function setPet(Pet $pet)
    {
        $this->pet = $pet;

        return $this;
    }

    /**
     * Get pet
     *
     * @return Pet 
     */
    public function getPet()
    {
        return $this->pet;
    }

    /**
     * {@inheritence}
     */
    public function getUsers()
    {
        if ($this->getPet() === null) {
            return null;
        }

        return $this->getPet()->getOrganization()->getUsers();
    }

}
