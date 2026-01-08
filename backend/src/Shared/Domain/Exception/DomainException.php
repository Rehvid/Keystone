<?php

declare(strict_types=1);

namespace Keystone\Shared\Domain\Exception;

abstract class DomainException extends \RuntimeException
{
    /** @param array<string, mixed> $details */
    public function __construct(
        string $message,
        private readonly array $details = [],
    ) {
        parent::__construct($message);
    }

    /** @return array<string, mixed> */
    public function getDetails(): array
    {
        return $this->details;
    }
}
