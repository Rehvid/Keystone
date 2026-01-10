<?php

declare(strict_types=1);

namespace Keystone\Shared\Infrastructure\Http\Factory;

use Keystone\Shared\Infrastructure\Http\Context\ExecutionContext;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Uid\Uuid;

final readonly class ExecutionContextFactory
{
    public function createFromRequest(Request $request): ExecutionContext
    {
        $requestId = $request->headers->get('X-Request-Id') ?? Uuid::v7()->toRfc4122();

        return new ExecutionContext(
            id: $requestId,
            startedAt: new \DateTimeImmutable(),
            ip: $request->getClientIp() ?? 'unknown',
            userAgent: $request->headers->get('User-Agent', 'unknown'),
        );
    }
}
