<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class LoginController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function loginRedirect()
    {
        $loginCheck = $this->generateUrl('app_login_check', [], UrlGeneratorInterface::ABSOLUTE_URL);

        $target = 'http://18.209.27.249/authorize?redirect_uri='.$loginCheck;

        return $this->redirect($target);
    }

    /**
     * @Route("/login/check", name="app_login_check")
     */
    public function loginCheck()
    {
        throw new \Exception('method should be intercepted by a listener');
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \Exception('method should be intercepted by a listener');
    }
}
