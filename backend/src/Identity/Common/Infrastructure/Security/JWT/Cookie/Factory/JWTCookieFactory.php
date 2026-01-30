<?php

declare(strict_types=1);

namespace Keystone\Identity\Common\Infrastructure\Security\JWT\Cookie\Factory;

use Keystone\Identity\Common\Domain\Exception\JWT\InvalidJWTFormatException;
use Keystone\Identity\Common\Infrastructure\Security\JWT\Cookie\DTO\JWTCookiesDTO;
use Keystone\Shared\Domain\ValueObject\CookieConfiguration;
use Keystone\Shared\Infrastructure\Http\Factory\CookieFactory;

final readonly class JWTCookieFactory
{
    private const string SEPARATOR = '.';

    private const int EXPECTED_PARTS = 3;

    public function __construct(
        private CookieConfiguration $payloadConfiguration,
        private CookieConfiguration $signatureConfiguration,
        private CookieFactory $factory,
    ) {
    }

    public function create(string $jwt): JWTCookiesDTO
    {
        $parts = explode(self::SEPARATOR, $jwt);

        if (self::EXPECTED_PARTS !== count($parts)) {
            throw InvalidJWTFormatException::invalidPartsCount(expected: self::EXPECTED_PARTS, actual: count($parts));
        }

        [$header, $payload, $signature] = $parts;

        return new JWTCookiesDTO(
            payload: $this->factory->create("{$header}.{$payload}", $this->payloadConfiguration),
            signature: $this->factory->create($signature, $this->signatureConfiguration),
        );
    }
}
