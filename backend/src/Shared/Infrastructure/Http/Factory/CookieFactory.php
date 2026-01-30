<?php

declare(strict_types=1);

namespace Keystone\Shared\Infrastructure\Http\Factory;

use Keystone\Shared\Domain\ValueObject\CookieConfiguration;
use Symfony\Component\HttpFoundation\Cookie;

final class CookieFactory
{
    public function create(string $value, CookieConfiguration $config): Cookie
    {
        $expires = $config->getLifetime() > 0 ? new \DateTimeImmutable("+{$config->getLifetime()} seconds") : 0;

        return Cookie::create($config->getName())
            ->withValue($value)
            ->withExpires($expires)
            ->withPath($config->getPath())
            ->withSecure($config->isSecure())
            ->withHttpOnly($config->isHttpOnly())
            ->withSameSite($config->getSameSite()->value);
    }
}
