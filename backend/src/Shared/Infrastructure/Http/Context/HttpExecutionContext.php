<?php

declare(strict_types=1);

namespace Keystone\Shared\Infrastructure\Http\Context;

use Keystone\Shared\Application\ValueObject\ExecutionContext;

final readonly class HttpExecutionContext extends ExecutionContext
{
    public function __construct(
        string $id,
        \DateTimeImmutable $startedAt,
        private ?string $ip = null,
        private ?string $userAgent = null,
    ) {
        parent::__construct($id, $startedAt);
    }

    public function ip(): ?string
    {
        return $this->ip;
    }

    public function userAgent(): ?string
    {
        return $this->userAgent;
    }
}
