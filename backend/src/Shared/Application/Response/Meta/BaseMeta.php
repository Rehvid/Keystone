<?php

declare(strict_types=1);

namespace Keystone\Shared\Application\Response\Meta;

abstract readonly class BaseMeta implements MetaPayloadInterface
{
    public function __construct(
        public string $requestId,
        public string $timestamp,
    ) {
    }

    /** @return array<string, mixed> */
    public function toArray(): array
    {
        return [
            'requestId' => $this->requestId,
            'timestamp' => $this->timestamp,
        ];
    }
}
