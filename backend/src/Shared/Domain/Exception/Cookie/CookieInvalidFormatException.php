<?php

declare(strict_types=1);

namespace Keystone\Shared\Domain\Exception\Cookie;

use Keystone\Shared\Domain\Enum\SameSiteCookie;
use Keystone\Shared\Domain\Exception\DomainException;

final class CookieInvalidFormatException extends DomainException
{
    private function __construct(string $message)
    {
        parent::__construct($message);
    }

    public static function emptyName(): self
    {
        return new self('Cookie name cannot be empty');
    }

    public static function negativeLifetime(int $lifetime): self
    {
        return new self("Cookie lifetime cannot be negative, got {$lifetime}");
    }

    public static function invalidSameSite(string $value): self
    {
        $allowed = implode(', ', array_column(SameSiteCookie::cases(), 'value'));

        return new self("Invalid SameSite value '{$value}'. Allowed: {$allowed}");
    }
}
