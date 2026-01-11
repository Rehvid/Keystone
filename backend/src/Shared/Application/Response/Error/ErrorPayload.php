<?php

declare(strict_types=1);

namespace Keystone\Shared\Application\Response\Error;

final readonly class ErrorPayload
{
    /** @param ErrorDetail[] $details */
    public function __construct(
        public string $code,
        public string $message,
        public array $details = [],
    ) {
    }

    /** @return array<string, mixed> */
    public function toArray(): array
    {
        $payload = [
            'code' => $this->code,
            'message' => $this->message,
        ];

        if (!empty($this->details)) {
            $payload['details'] = array_map(
                static fn (ErrorDetail $detail): array => $detail->toArray(),
                $this->details,
            );
        }

        return $payload;
    }
}
