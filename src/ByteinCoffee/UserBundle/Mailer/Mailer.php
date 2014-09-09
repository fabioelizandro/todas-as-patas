<?php

namespace ByteinCoffee\UserBundle\Mailer;

use FOS\UserBundle\Mailer\Mailer as BaseMailer;
use FOS\UserBundle\Model\UserInterface;

/**
 * @author Fábio Lemos Elizandro <fabio@elizandro.com.br>
 */
class Mailer extends BaseMailer
{

    /**
     * {@inheritdoc}
     */
    public function sendResettingEmailMessage(UserInterface $user)
    {
        $template = $this->parameters['resetting.template'];
        $rendered = $this->templating->render($template, array(
            'user' => $user,
            'token' => $user->getConfirmationToken()
        ));
        $this->sendEmailMessage($rendered, $this->parameters['from_email']['resetting'], $user->getEmail());
    }

    /**
     * Seta um parametro
     * 
     * @param string $key
     * @param mixed $value
     * 
     * @return Mailer self
     */
    public function setParameter($key, $value)
    {
        $this->parameters[$key] = $value;

        return $this;
    }

}
