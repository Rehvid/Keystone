<?php

declare(strict_types=1);

namespace Keystone\Identity\User\Infrastructure\Security\JWT;

use Keystone\Identity\Common\Infrastructure\Security\JWT\Cookie\Factory\JWTCookieFactory;
use Keystone\Shared\Application\Factory\AppPayloadFactory;
use Keystone\Shared\Infrastructure\Http\Response\ApiResponse;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;

final readonly class JWTCookieAuthenticationSuccessHandler implements AuthenticationSuccessHandlerInterface
{
    public function __construct(
        private JWTTokenManagerInterface $jwtManager,
        private JWTCookieFactory $jwtCookieFactory,
        private AppPayloadFactory $payloadFactory,
    ) {
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token): ?Response
    {
        $user = $token->getUser();
        if (!$user) {
            return null;
        }

        $jwt = $this->jwtManager->create($user);

        $cookies = $this->jwtCookieFactory->create($jwt);

        $response = new ApiResponse($this->payloadFactory->successEmpty());
        $response->headers->setCookie($cookies->payload);
        $response->headers->setCookie($cookies->signature);

        return $response;
    }
}
