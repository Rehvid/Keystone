<?php

declare(strict_types=1);

namespace Keystone\Shared\Domain\Exception\Email;

use Keystone\Shared\Domain\Exception\DomainException;

final class InvalidEmailFormatException extends DomainException
{
    public static function create(string $email): self
    {
        return new self(
            message: sprintf('Invalid email format: "%s"', $email),
            details: ['field' => $email],
        );
    }
}
