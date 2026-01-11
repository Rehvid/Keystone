<?php

declare(strict_types=1);

namespace Keystone\Shared\Application\Response\Error;

final readonly class ErrorDetail
{
    /** @param array<string, mixed> $details */
    public function __construct(
        public string $code,
        public string $message,
        public ?string $path = null,
        public array $details = [],
    ) {
    }

    /** @return array<string, mixed> */
    public function toArray(): array
    {
        $data = [
            'code' => $this->code,
            'message' => $this->message,
        ];

        if (null !== $this->path) {
            $data['path'] = $this->path;
        }

        if (!empty($this->details)) {
            $data['details'] = $this->details;
        }

        return $data;
    }
}
