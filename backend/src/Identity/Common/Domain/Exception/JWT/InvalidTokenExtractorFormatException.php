<?php

declare(strict_types=1);

namespace Keystone\Identity\Common\Domain\Exception\JWT;

use Keystone\Identity\Common\Domain\Exception\IdentityException;

final class InvalidTokenExtractorFormatException extends IdentityException
{
    private function __construct(string $message)
    {
        parent::__construct($message);
    }

    public static function emptyPayloadCookieName(): self
    {
        return new self('Payload cookie name cannot be empty');
    }

    public static function emptySignatureCookieName(): self
    {
        return new self('Signature cookie name cannot be empty');
    }
}
