<?php

namespace TodasAsPatas\ApiBundle\Entity;

/**
 * @author Fábio Lemos Elizandro <fabio@elizandro.com.br>
 */
interface NotificationPrototypeInterface
{

    /**
     * Get Users
     * 
     * @return User 
     */
    public function getUsers();

    /**
     * Get Title
     * 
     * @return string 
     */
    public function getTitle();

    /**
     * Get Message
     * 
     * @return string 
     */
    public function getMessage();
}
