<?php

declare(strict_types=1);

namespace Keystone\Shared\Domain\ValueObject;

use Keystone\Shared\Domain\Enum\SameSiteCookie;
use Keystone\Shared\Domain\Exception\Cookie\CookieInvalidFormatException;

final readonly class CookieConfiguration
{
    private SameSiteCookie $sameSiteCookie;

    public function __construct(
        private string $name,
        private string $path = '/',
        private int $lifetime = 3600,
        private bool $isSecure = true,
        private bool $httpOnly = true,
        SameSiteCookie|string $sameSite = SameSiteCookie::LAX,
    ) {
        if ('' === $name) {
            throw CookieInvalidFormatException::emptyName();
        }

        if ($lifetime < 0) {
            throw CookieInvalidFormatException::negativeLifetime($this->lifetime);
        }

        if (is_string($sameSite)) {
            $sameSite = strtolower($sameSite);
            $sameSite = SameSiteCookie::tryFrom($sameSite) ?? throw CookieInvalidFormatException::invalidSameSite($sameSite);
        }

        $this->sameSiteCookie = $sameSite;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getLifetime(): int
    {
        return $this->lifetime;
    }

    public function isSecure(): bool
    {
        return $this->isSecure;
    }

    public function isHttpOnly(): bool
    {
        return $this->httpOnly;
    }

    public function getSameSite(): SameSiteCookie
    {
        return $this->sameSiteCookie;
    }
}
