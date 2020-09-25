<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;

class SimpleSSOAuthenticator extends AbstractGuardAuthenticator
{
    private $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    public function supports(Request $request)
    {
        //$request->query->get('page'); // ?page=

        //dd($request->attributes->get('_controller'));
        return $request->attributes->get('_route') === 'app_login_check';

        return $request->getPathInfo() === '/login/check';
    }

    public function getCredentials(Request $request)
    {
        return [
            'email' => $request->query->get('email'),
            'name' => $request->query->get('name'),
        ];
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        // take the code, make an API request to our SSO to get
        // the user details
        // use those details to create the User object and return it

        $user = new User();
        $user->setEmail($credentials['email']);
        $user->setName($credentials['name']);
        $user->setRoles(['ROLE_USER']);

        return $user;
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        return true;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        // todo
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $providerKey)
    {
        $url = $this->router->generate('app_lucky_number', ['max' => 10]);

        return new RedirectResponse($url);
    }

    public function start(Request $request, AuthenticationException $authException = null)
    {
        $url = $this->router->generate('app_login');

        return new RedirectResponse($url);
    }

    public function supportsRememberMe()
    {
        // todo
    }
}
