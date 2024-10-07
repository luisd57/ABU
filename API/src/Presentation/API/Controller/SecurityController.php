<?php

namespace App\Presentation\API\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController
{
    #[Route('/api/login', name: 'app_login', methods: ['POST'])]
    public function login(): Response
    {
        // This should not be called, authentication is handled by AppAuthenticator
        throw new \LogicException('This method should not be reached!');
    }

    #[Route('/api/is-authenticated', name: 'app_is_authenticated', methods: ['GET'])]
    public function isAuthenticated(Security $security): JsonResponse
    {
        $user = $security->getUser();
        if ($user) {
            return new JsonResponse([
                'authenticated' => true,
                'user' => [
                    'email' => $user->getUserIdentifier(),
                    'roles' => $user->getRoles(),
                ]
            ]);
        }

        return new JsonResponse(['authenticated' => false]);
    }

    #[Route('/api/logout', name: 'app_logout', methods: ['POST'])]
    public function logout(): Response
    {
        // This method will never be executed
        throw new \LogicException('This method should never be reached!');
    }
}