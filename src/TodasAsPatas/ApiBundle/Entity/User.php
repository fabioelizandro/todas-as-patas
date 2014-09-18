<?php

namespace TodasAsPatas\ApiBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;

/**
 * @author Fábio Lemos Elizandro <fabio@elizandro.com.br>
 */
abstract class User extends BaseUser
{

    /**
     * Utilizado para que se confirme que o usuário é o verdadeiro 
     * usuário para trocar suas informações pessoais 
     * 
     * @var string
     */
    protected $confirmationPassword;

    /**
     * Get confirmation passsword
     * 
     * @return string
     */
    public function getConfirmationPassword()
    {
        return $this->confirmationPassword;
    }

    /**
     * Set confirmation password
     * 
     * @param string $confirmationPassword
     * @return User
     */
    public function setConfirmationPassword($confirmationPassword)
    {
        $this->confirmationPassword = $confirmationPassword;

        return $this;
    }

    /**
     * Verifica se o usuário possui um password valido
     */
    public function isPasswordValid()
    {
        $password = $this->getPlainPassword();
        $passwordBlank = (false === $password || (empty($password) && '0' != $password));

        return !(null === $this->getId() && true === $passwordBlank);
    }

}
