<?php

declare(strict_types=1);

namespace Keystone\Identity\Common\Infrastructure\Security\JWT;

use Keystone\Identity\Common\Application\Enum\AuthenticationErrorCode;
use Keystone\Shared\Application\Factory\AppPayloadFactory;
use Keystone\Shared\Application\Factory\ErrorPayloadFactory;
use Keystone\Shared\Application\Response\AppPayload;
use Keystone\Shared\Infrastructure\Http\Response\ApiResponse;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationFailureEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTExpiredEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTInvalidEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTNotFoundEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Events;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpFoundation\Response;

final readonly class JWTAuthenticationErrorListener
{
    public function __construct(
        private AppPayloadFactory $payloadFactory,
        private ErrorPayloadFactory $errorPayloadFactory,
    ) {
    }

    #[AsEventListener(Events::AUTHENTICATION_FAILURE)]
    public function onAuthenticationFailure(AuthenticationFailureEvent $event): void
    {
        $payload = $this->createAppPayload(
            code: AuthenticationErrorCode::INVALID_CREDENTIALS->value,
            message: 'Invalid credentials.',
        );

        $event->setResponse(new ApiResponse(
            payload: $payload,
            status: Response::HTTP_UNAUTHORIZED,
        ));
    }

    #[AsEventListener(Events::JWT_INVALID)]
    public function onJWTInvalid(JWTInvalidEvent $event): void
    {
        $payload = $this->createAppPayload(
            code: AuthenticationErrorCode::JWT_INVALID_TOKEN->value,
            message: 'The provided token is invalid. Please log in again.',
        );

        $event->setResponse(new ApiResponse(
            payload: $payload,
            status: Response::HTTP_UNAUTHORIZED,
        ));
    }

    #[AsEventListener(Events::JWT_EXPIRED)]
    public function onJWTExpired(JWTExpiredEvent $event): void
    {
        $payload = $this->createAppPayload(
            code: AuthenticationErrorCode::JWT_EXPIRED_TOKEN->value,
            message: 'Your session has expired. Please log in again.',
        );

        $event->setResponse(new ApiResponse(
            payload: $payload,
            status: Response::HTTP_UNAUTHORIZED,
        ));
    }

    #[AsEventListener(Events::JWT_NOT_FOUND)]
    public function onJWTNotFound(JWTNotFoundEvent $event): void
    {
        $payload = $this->createAppPayload(
            code: AuthenticationErrorCode::JWT_MISSING_TOKEN->value,
            message: 'Authentication token is missing. Please log in.',
        );

        $event->setResponse(new ApiResponse(
            payload: $payload,
            status: Response::HTTP_UNAUTHORIZED,
        ));
    }

    private function createAppPayload(string $code, string $message): AppPayload
    {
        return $this->payloadFactory->error(
            $this->errorPayloadFactory->createErrorPayload(
                code: $code,
                message: $message,
            ),
        );
    }
}
