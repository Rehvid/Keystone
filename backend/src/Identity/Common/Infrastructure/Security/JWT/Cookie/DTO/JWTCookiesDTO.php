<?php

declare(strict_types=1);

namespace Keystone\Identity\Common\Infrastructure\Security\JWT\Cookie\DTO;

use Symfony\Component\HttpFoundation\Cookie;

final readonly class JWTCookiesDTO
{
    public function __construct(
        public Cookie $payload,
        public Cookie $signature,
    ) {
    }
}
