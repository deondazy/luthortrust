<?php

declare(strict_types=1);

namespace Denosys\App\Controllers;

use Denosys\Core\Controller\AbstractController;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface;
use Denosys\App\Services\UserAuthenticationService;
use Symfony\Component\Security\Core\Exception\AuthenticationException;

class AuthController extends AbstractController
{
    public function showLoginForm(): Response
    {
        return $this->view('auth.login', ['current_timezone' => date_default_timezone_get()]);
    }

    public function login(
        ServerRequestInterface $request,
        UserAuthenticationService $authService
    ): Response {
        $formData = $request->getParsedBody();

        try {
            $authService->login($formData);

            return $this->redirectToRoute('account.index');
        } catch (AuthenticationException $e) {
            return $this->redirectToRoute('login')
                ->withFlash('error', $e->getMessage());
        }
    }

    public function showRegistrationForm(): Response
    {
        return $this->view('auth.register');
    }

    public function register(
        ServerRequestInterface $request,
        UserAuthenticationService $authenticationService
    ): Response {
        $formData = $request->getParsedBody();

        $authenticationService->register($formData);

        return $this->redirectToRoute('login');
    }

    public function forgotPassword(): Response
    {
        return $this->view('auth/forgot-password');
    }

    public function logout(UserAuthenticationService $authenticationService): Response
    {
        $authenticationService->logout();

        return $this->redirectToRoute('home');
    }
}
