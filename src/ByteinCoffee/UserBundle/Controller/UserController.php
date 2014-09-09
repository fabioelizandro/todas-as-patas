<?php

namespace ByteinCoffee\UserBundle\Controller;

use ByteinCoffee\ExtraBundle\Controller\Controller as BaseController;
use FOS\UserBundle\Model\UserManagerInterface;
use TodasAsPatas\ApiBundle\Entity\User;
use Sylius\Bundle\ResourceBundle\Event\ResourceEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Symfony\Component\Security\Core\Util\StringUtils;

/**
 * @author Fábio Lemos Elizandro <fabio@elizandro.com.br>
 */
class UserController extends BaseController
{

    /**
     * Exibi o perfil atual
     * 
     * @param Request $request
     */
    public function profileAction(Request $request)
    {
        $view = $this
                ->view()
                ->setTemplate($this->config->getTemplate('profile.html'))
                ->setTemplateVar($this->config->getResourceName())
                ->setData($this->findOr404($request, array('id' => $this->getUser()->getId())))
        ;

        return $this->handleView($view);
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse|Response
     */
    public function profileUpdateAction(Request $request)
    {
        $userManager = $this->get('fos_user.user_manager');
        /* @var $userManager UserManagerInterface */
        $dispatcher = $this->get('event_dispatcher');
        /* @var $dispatcher EventDispatcherInterface */

        $user = $this->findOr404($request, array('id' => $this->getUser()->getId()));
        $form = $this->createUpdateForm($user);

        if (($request->isMethod('PUT') || $request->isMethod('POST')) && $form->submit($request)->isValid()) {
            $dispatcher->dispatch($this->config->getEventName('pre_update'), new ResourceEvent($user, array('form' => $form)));
            $userManager->updateUser($user);
            $dispatcher->dispatch($this->config->getEventName('post_update'), new ResourceEvent($user, array('form' => $form)));

            if ($this->config->isApiRequest()) {
                return $this->handleView($this->view($user));
            }

            return $this->redirectHandler->redirectTo($user);
        }

        if ($this->config->isApiRequest()) {
            return $this->handleView($this->view($form));
        }

        $view = $this
                ->view()
                ->setTemplate($this->config->getTemplate('profile_update.html'))
                ->setData(array(
            $this->config->getResourceName() => $user,
            'form' => $form->createView()
                ))
        ;

        return $this->handleView($view);
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse|Response
     */
    public function secureProfileUpdateAction(Request $request)
    {
        /* @var $userManager UserManagerInterface */
        /* @var $dispatcher EventDispatcherInterface */
        /* @var $encoderFactory EncoderFactoryInterface */
        /* @var $encoder PasswordEncoderInterface */
        /* @var $user User */
        $userManager = $this->get('fos_user.user_manager');
        $dispatcher = $this->get('event_dispatcher');

        $user = $this->findOr404($request, array('id' => $this->getUser()->getId()));
        $form = $this->createUpdateForm($user);

        if (($request->isMethod('PUT') || $request->isMethod('POST')) && $form->submit($request)->isValid()) {

            $encoderFactory = $this->get('security.encoder_factory');
            $encoder = $encoderFactory->getEncoder($user);

            if (null === $user->getConfirmationPassword()) {
                throw new BadRequestHttpException('O usuário tem que confirmar a senha atual!');
            }

            if (false === StringUtils::equals($user->getPassword(), $encoder->encodePassword($user->getConfirmationPassword(), $user->getSalt()))) {
                throw $this->createAccessDeniedException('A senha não confere para alterações das informações!');
            }

            $dispatcher->dispatch($this->config->getEventName('pre_update'), new ResourceEvent($user, array('form' => $form)));
            $userManager->updateUser($user);
            $dispatcher->dispatch($this->config->getEventName('post_update'), new ResourceEvent($user, array('form' => $form)));

            if ($this->config->isApiRequest()) {
                return $this->handleView($this->view($user));
            }

            return $this->redirectHandler->redirectTo($user);
        }

        if ($this->config->isApiRequest()) {
            return $this->handleView($this->view($form));
        }

        $view = $this
                ->view()
                ->setTemplate($this->config->getTemplate('profile_update.html'))
                ->setData(array(
            $this->config->getResourceName() => $user,
            'form' => $form->createView()
                ))
        ;

        return $this->handleView($view);
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse|Response
     */
    public function updateAction(Request $request)
    {
        $userManager = $this->get('fos_user.user_manager');
        /* @var $userManager UserManagerInterface */
        $dispatcher = $this->get('event_dispatcher');
        /* @var $dispatcher EventDispatcherInterface */

        $user = $this->findOr404($request);
        $form = $this->createUpdateForm($user);

        if (($request->isMethod('PUT') || $request->isMethod('POST')) && $form->submit($request)->isValid()) {
            $dispatcher->dispatch($this->config->getEventName('pre_update'), new ResourceEvent($user, array('form' => $form)));
            $userManager->updateUser($user);
            $dispatcher->dispatch($this->config->getEventName('post_update'), new ResourceEvent($user, array('form' => $form)));

            if ($this->config->isApiRequest()) {
                return $this->handleView($this->view($user));
            }

            return $this->redirectHandler->redirectTo($user);
        }

        if ($this->config->isApiRequest()) {
            return $this->handleView($this->view($form));
        }

        $view = $this
                ->view()
                ->setTemplate($this->config->getTemplate('update.html'))
                ->setData(array(
            $this->config->getResourceName() => $user,
            'form' => $form->createView()
                ))
        ;

        return $this->handleView($view);
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse|Response
     */
    public function secureUpdateAction(Request $request)
    {
        /* @var $userManager UserManagerInterface */
        /* @var $dispatcher EventDispatcherInterface */
        /* @var $user User */
        /* @var $encoderFactory EncoderFactoryInterface */
        /* @var $encoder PasswordEncoderInterface */
        $userManager = $this->get('fos_user.user_manager');
        $dispatcher = $this->get('event_dispatcher');


        $user = $this->findOr404($request);
        $form = $this->createUpdateForm($user);

        if (($request->isMethod('PUT') || $request->isMethod('POST')) && $form->submit($request)->isValid()) {

            $encoderFactory = $this->get('security.encoder_factory');
            $encoder = $encoderFactory->getEncoder($user);

            if (null === $user->getConfirmationPassword()) {
                throw new BadRequestHttpException('O usuário tem que confirmar a senha atual!');
            }

            if (false === StringUtils::equals($user->getPassword(), $encoder->encodePassword($user->getConfirmationPassword(), $user->getSalt()))) {
                throw $this->createAccessDeniedException('A senha não confere para alterações das informações!');
            }

            $dispatcher->dispatch($this->config->getEventName('pre_update'), new ResourceEvent($user, array('form' => $form)));
            $userManager->updateUser($user);
            $dispatcher->dispatch($this->config->getEventName('post_update'), new ResourceEvent($user, array('form' => $form)));

            if ($this->config->isApiRequest()) {
                return $this->handleView($this->view($user));
            }

            return $this->redirectHandler->redirectTo($user);
        }

        if ($this->config->isApiRequest()) {
            return $this->handleView($this->view($form));
        }

        $view = $this
                ->view()
                ->setTemplate($this->config->getTemplate('update.html'))
                ->setData(array(
            $this->config->getResourceName() => $user,
            'form' => $form->createView()
                ))
        ;

        return $this->handleView($view);
    }

    /**
     * Registra um usuário na base de dados
     * 
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function createAction(Request $request)
    {
        $userManager = $this->get('fos_user.user_manager');
        /* @var $userManager UserManagerInterface */
        $user = $this->createNew();
        /* @var $user User */
        $dispatcher = $this->get('event_dispatcher');
        /* @var $dispatcher EventDispatcherInterface */

        $user->setEnabled(true);
        $form = $this->createCreateForm($user);

        if ($request->isMethod('POST') && $form->submit($request)->isValid()) {
            $dispatcher->dispatch($this->config->getEventName('pre_create'), new ResourceEvent($user, array('form' => $form, 'confirmation' => $request->get('_sylius[confirmation]', true, true))));
            $userManager->updateUser($user);
            $dispatcher->dispatch($this->config->getEventName('post_create'), new ResourceEvent($user, array('form' => $form, 'confirmation' => $request->get('_sylius[confirmation]', true, true))));

            if ($this->config->isApiRequest()) {
                return $this->handleView($this->view($user));
            }

            return $this->redirectHandler->redirectTo($user);
        }

        if ($this->config->isApiRequest()) {
            return $this->handleView($this->view($form));
        }

        $view = $this
                ->view()
                ->setTemplate($this->config->getTemplate('create.html'))
                ->setData(array(
            $this->config->getResourceName() => $user,
            'form' => $form->createView()
                ))
        ;

        return $this->handleView($view);
    }

}
