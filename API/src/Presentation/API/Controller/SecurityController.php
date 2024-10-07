<?php

namespace App\Presentation\API\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route('/api/login', name: 'app_login', methods: ['POST'])]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // Authentication is handled by the AppAuthenticator
        // This method will not be called on successful authentication
        $error = $authenticationUtils->getLastAuthenticationError();
        return $this->json(['error' => $error?->getMessage()], Response::HTTP_UNAUTHORIZED);
    }

    #[Route('/api/logout', name: 'app_logout', methods: ['POST'])]
    public function logout(): void
    {
        //intercepted by the logout key on firewall
    }
}