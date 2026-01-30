<?php

declare(strict_types=1);

namespace Keystone\Identity\Common\Domain\Exception\JWT;

use Keystone\Identity\Common\Domain\Exception\IdentityException;

final class InvalidJWTFormatException extends IdentityException
{
    private function __construct(string $message)
    {
        parent::__construct($message);
    }

    public static function invalidPartsCount(int $expected, int $actual): self
    {
        return new self(
            sprintf(
                'JWT must contain exactly %d parts, got %d',
                $expected,
                $actual,
            ),
        );
    }
}
