<?php

declare(strict_types=1);

namespace Keystone\Shared\Application\ValueObject;

readonly class ExecutionContext
{
    public function __construct(
        private string $id,
        private \DateTimeImmutable $startedAt,
    ) {
    }

    public function id(): string
    {
        return $this->id;
    }

    public function startedAt(): \DateTimeImmutable
    {
        return $this->startedAt;
    }

    public function startedAtFormatted(): string
    {
        return $this->startedAt->format(\DateTimeInterface::ATOM);
    }
}
