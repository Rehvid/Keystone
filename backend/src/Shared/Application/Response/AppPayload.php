<?php

declare(strict_types=1);

namespace Keystone\Shared\Application\Response;

use Keystone\Shared\Application\Enum\StatusPayload;
use Keystone\Shared\Application\Response\Error\ErrorPayload;
use Keystone\Shared\Application\Response\Meta\MetaPayloadInterface;

final readonly class AppPayload
{
    public function __construct(
        public StatusPayload $status,
        public MetaPayloadInterface $metaPayload,
        public mixed $data = null,
        public ?ErrorPayload $errorPayload = null,
    ) {
    }

    /** @return array<string, mixed> */
    public function toArray(): array
    {
        $payload = [
            'status' => strtolower($this->status->value),
            'meta' => $this->metaPayload->toArray(),
        ];

        return match ($this->status) {
            StatusPayload::ERROR => array_merge($payload, [
                'error' => $this->errorPayload?->toArray(),
            ]),

            StatusPayload::SUCCESS => array_merge($payload, [
                'data' => $this->data,
            ]),

            StatusPayload::SUCCESS_EMPTY => $payload,
        };
    }
}
