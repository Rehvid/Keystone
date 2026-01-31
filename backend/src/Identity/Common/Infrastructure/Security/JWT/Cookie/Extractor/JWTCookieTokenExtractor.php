<?php

declare(strict_types=1);

namespace Keystone\Identity\Common\Infrastructure\Security\JWT\Cookie\Extractor;

use Keystone\Identity\Common\Domain\ValueObject\TokenExtractorConfiguration;
use Lexik\Bundle\JWTAuthenticationBundle\TokenExtractor\TokenExtractorInterface;
use Symfony\Component\HttpFoundation\Request;

final readonly class JWTCookieTokenExtractor implements TokenExtractorInterface
{
    public function __construct(
        private TokenExtractorConfiguration $configuration,
    ) {
    }

    public function extract(Request $request): string
    {
        $payload = $request->cookies->get($this->configuration->getPayloadCookieName());
        $signature = $request->cookies->get($this->configuration->getSignatureCookieName());

        if (!$payload || !$signature) {
            return '';
        }

        return sprintf('%s.%s', $payload, $signature);
    }
}
