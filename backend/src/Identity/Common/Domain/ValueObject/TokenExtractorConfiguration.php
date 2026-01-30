<?php

declare(strict_types=1);

namespace Keystone\Identity\Common\Domain\ValueObject;

use Keystone\Identity\Common\Domain\Exception\JWT\InvalidTokenExtractorFormatException;

final readonly class TokenExtractorConfiguration
{
    public function __construct(
        private string $payloadCookieName,
        private string $signatureCookieName,
    ) {
        if ('' === $this->payloadCookieName) {
            throw InvalidTokenExtractorFormatException::emptyPayloadCookieName();
        }

        if ('' === $this->signatureCookieName) {
            throw InvalidTokenExtractorFormatException::emptySignatureCookieName();
        }
    }

    public function getPayloadCookieName(): string
    {
        return $this->payloadCookieName;
    }

    public function getSignatureCookieName(): string
    {
        return $this->signatureCookieName;
    }
}
