<?php

namespace ByteinCoffee\UserBundle\Controller;

use ByteinCoffee\ExtraBundle\Controller\Controller as BaseController;
use ByteinCoffee\ExtraBundle\Sylius\Configuration;
use ByteinCoffee\ExtraBundle\Sylius\ConfigurationFactory;
use ByteinCoffee\UserBundle\Mailer\Mailer;
use DateTime;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Model\UserInterface;
use Sylius\Bundle\ResourceBundle\Controller\FlashHelper;
use Sylius\Bundle\ResourceBundle\Controller\RedirectHandler;
use Sylius\Bundle\ResourceBundle\Controller\ResourceResolver;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Controlador para reset de senha que da suporte a SyliusResourceBundle
 */
class ResettingController extends BaseController
{

    /**
     * @var Configuration
     */
    protected $config;

    public function __construct(ConfigurationFactory $configurationFactory, $templateNamespace, $templatingEngine = 'twig')
    {
        $this->config = $configurationFactory->createConfiguration(
                "ByteinCoffeeUserBundle", null, $templateNamespace, $templatingEngine
        );
    }

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;

        $this->resourceResolver = new ResourceResolver($this->config);
        if (null !== $container) {
            $this->redirectHandler = new RedirectHandler($this->config, $container->get('router'));
            $this->flashHelper = new FlashHelper(
                    $this->config, $container->get('translator'), $container->get('session')
            );
        }

        $requestStack = $container->get("request_stack");
        /* @var $requestStack RequestStack */
        $this->config->setRequest($requestStack->getCurrentRequest());
    }

    /**
     * Request reset user password: show form
     */
    public function requestAction()
    {
        $view = $this
                ->view()
                ->setTemplate($this->config->getTemplate('request.html'))
        ;
        return $this->handleView($view);
    }

    /**
     * Request reset user password: submit form and send email
     */
    public function sendEmailAction(Request $request)
    {
        $username = $request->request->get('username');

        /** @var $user UserInterface */
        $user = $this->container->get('fos_user.user_manager')->findUserByUsernameOrEmail($username);

        if (null === $user) {
            $view = $this
                    ->view()
                    ->setStatusCode(404)
                    ->setTemplate($this->config->getTemplate('request.html'))
                    ->setData(array('email_send' => false, 'message' => 'Usuário não encontrado!'))
            ;
            return $this->handleView($view);
        }

        if ($user->isPasswordRequestNonExpired($this->container->getParameter('fos_user.resetting.token_ttl'))) {

            $this->get('session')->getBag('flashes')->add('user.resetting', 'resetting.password_already_requested');

            $view = $this
                    ->view()
                    ->setStatusCode(400)
                    ->setTemplate($this->config->getTemplate('passwordAlreadyRequested.html'))
                    ->setData(array('email_send' => false, 'message' => 'Você já requisitou a recuperação de senha!'))
            ;
            return $this->handleView($view);
        }

        if (null === $user->getConfirmationToken()) {
            /** @var $tokenGenerator \FOS\UserBundle\Util\TokenGeneratorInterface */
            $tokenGenerator = $this->container->get('fos_user.util.token_generator');
            $user->setConfirmationToken($tokenGenerator->generateToken());
        }

        $mailer = $this->container->get('fos_user.mailer');
        /* @var $mailer Mailer */
        if ($this->config->get('resetting.template')) {
            $mailer->setParameter('resetting.template', $this->config->get('resetting.template'));
        }
        
        $mailer->sendResettingEmailMessage($user);
        $user->setPasswordRequestedAt(new DateTime());
        $this->container->get('fos_user.user_manager')->updateUser($user);

        if ($this->config->isApiRequest()) {
            $view = $this
                    ->view()
                    ->setTemplate($this->config->getTemplate('passwordAlreadyRequested.html'))
                    ->setData(array('email_send' => true, 'message' => 'Foi enviado um e-mail com o link para a recuperação da senha!'))
            ;
            return $this->handleView($view);
        }

        return $this->redirectHandler->redirectToRoute($this->config->getRedirectRoute(''), array('email' => $this->getObfuscatedEmail($user)));
    }

    /**
     * Tell the user to check his email provider
     */
    public function checkEmailAction(Request $request)
    {
        $email = $request->query->get('email');

        if (empty($email)) {
            return $this->redirectHandler->redirectToRoute($this->config->getRedirectRoute(''));
        }

        $view = $this
                ->view()
                ->setTemplate($this->config->getTemplate('check_email.html'))
                ->setData(array('email' => $email))
        ;

        return $this->handleView($view);
    }

    /**
     * Reset user password
     */
    public function resetAction(Request $request, $token)
    {
        /** @var $formFactory \FOS\UserBundle\Form\Factory\FactoryInterface */
        $formFactory = $this->container->get('fos_user.resetting.form.factory');
        /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
        $userManager = $this->container->get('fos_user.user_manager');
        /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
        $dispatcher = $this->container->get('event_dispatcher');

        $user = $userManager->findUserByConfirmationToken($token);

        if (null === $user) {
            throw $this->createNotFoundException(sprintf('The user with "confirmation token" does not exist for value "%s"', $token));
        }

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::RESETTING_RESET_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        $form = $formFactory->createForm();
        $form->setData($user);

        if ('POST' === $request->getMethod()) {
            $form->bind($request);

            if ($form->isValid()) {
                $event = new FormEvent($form, $request);
                $dispatcher->dispatch(FOSUserEvents::RESETTING_RESET_SUCCESS, $event);

                $userManager->updateUser($user);

                if (null === $response = $event->getResponse()) {

                    if ($this->config->isApiRequest()) {
                        $view = $this
                                ->view()
                                ->setTemplate($this->config->getTemplate('reset_success.html'))
                                ->setData(array('user' => $user))
                        ;
                        return $this->handleView($view);
                    }

                    $response = $this->redirectHandler->redirectToRoute($this->config->getRedirectRoute(''));
                }

                $dispatcher->dispatch(FOSUserEvents::RESETTING_RESET_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

                return $response;
            }
        }

        $view = $this
                ->view()
                ->setTemplate($this->config->getTemplate('reset.html'))
                ->setData(array('token' => $token, 'form' => $form->createView()))
        ;

        return $this->handleView($view);
    }

    /**
     * Get the truncated email displayed when requesting the resetting.
     *
     * The default implementation only keeps the part following @ in the address.
     *
     * @param UserInterface $user
     *
     * @return string
     */
    protected function getObfuscatedEmail(UserInterface $user)
    {
        $email = $user->getEmail();
        if (false !== $pos = strpos($email, '@')) {
            $email = '...' . substr($email, $pos);
        }

        return $email;
    }

}
