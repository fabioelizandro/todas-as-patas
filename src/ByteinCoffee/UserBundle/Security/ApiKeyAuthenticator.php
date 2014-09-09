<?php

namespace ByteinCoffee\UserBundle\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\SimplePreAuthenticatorInterface;
use Symfony\Component\Security\Core\Authentication\Token\PreAuthenticatedToken;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationFailureHandlerInterface;

class ApiKeyAuthenticator implements SimplePreAuthenticatorInterface, AuthenticationFailureHandlerInterface
{

    /**
     * @var ApiKeyUserProvider
     */
    protected $userProvider;

    /**
     * Segredo para gerar o api secret
     * 
     * @var string
     */
    protected $secret;

    /**
     * @var Segredo que está na requisição
     */
    protected $secretRequest;

    public function __construct(ApiKeyUserProvider $userProvider, $secret)
    {
        $this->userProvider = $userProvider;
        $this->secret = $secret;
    }

    public function createToken(Request $request, $providerKey)
    {
        if (!$request->headers->has('api-key')) {
            throw new BadCredentialsException('No API key found');
        }

        if (!$request->headers->has('api-secret')) {
            throw new BadCredentialsException('No API secret found');
        }

        $this->secretRequest = $request->headers->get('api-secret');

        return new PreAuthenticatedToken(
                'anon.', $request->headers->get('api-key'), $providerKey
        );
    }

    public function authenticateToken(TokenInterface $token, UserProviderInterface $userProvider, $providerKey)
    {
        $apiKey = $token->getCredentials();
        $username = $this->userProvider->getUsernameForApiKey($apiKey);

        if (!$username) {
            throw new AuthenticationException(
            sprintf('API Key "%s" does not exist.', $apiKey)
            );
        }

        $user = $this->userProvider->loadUserByUsername($username);

        if ($this->secretRequest !== $user->generateApiSecret($this->secret)) {
            throw new AuthenticationException(
            sprintf('API Secret "%s" does not exist.', $this->secretRequest)
            );
        }

        return new PreAuthenticatedToken(
                $user, $apiKey, $providerKey, $user->getRoles()
        );
    }

    public function supportsToken(TokenInterface $token, $providerKey)
    {
        return $token instanceof PreAuthenticatedToken && $token->getProviderKey() === $providerKey;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        return new Response("Authentication Failed. {$exception->getMessage()}", 403);
    }

}
