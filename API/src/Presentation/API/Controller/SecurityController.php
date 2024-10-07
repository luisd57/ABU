<?php

namespace App\Presentation\API\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route('/api/login', name: 'app_login', methods: ['POST'])]
    public function login(): Response
    {
        // This should not be called, authentication is handled by AppAuthenticator
        throw new \LogicException('This method should not be reached!');
    }

    #[Route('/api/logout', name: 'app_logout', methods: ['POST'])]
    public function logout(): void
    {
        //intercepted by the logout key on firewall
    }
}