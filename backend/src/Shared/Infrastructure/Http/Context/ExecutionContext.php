<?php

declare(strict_types=1);

namespace Keystone\Shared\Infrastructure\Http\Context;

final readonly class ExecutionContext
{
    public function __construct(
        public string $id,
        public \DateTimeImmutable $startedAt,
        public ?string $ip = null,
        public ?string $userAgent = null,
    ) {
    }

    public function duration(): string
    {
        return $this->startedAt->diff(new \DateTimeImmutable())->format('%s.%f');
    }
}
