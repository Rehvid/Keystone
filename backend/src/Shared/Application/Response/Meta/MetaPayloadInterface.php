<?php

declare(strict_types=1);

namespace Keystone\Shared\Application\Response\Meta;

interface MetaPayloadInterface
{
    public string $requestId { get; }
    public string $timestamp { get; }

    /** @return array<string, mixed> */
    public function toArray(): array;
}
