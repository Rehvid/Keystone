<?php

declare(strict_types=1);

namespace Keystone\Shared\Application\Response\Error;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'ErrorDetail',
    required: ['code', 'message'],
    type: 'object',
)]
final readonly class ErrorDetail
{
    /** @param array<string, mixed> $details */
    public function __construct(
        #[OA\Property(
            description: 'Unique error code',
            example: 'VALIDATION_ERROR',
        )]
        public string $code,
        #[OA\Property(
            description: 'Human-readable error message',
            example: 'The email field is required',
        )]
        public string $message,
        #[OA\Property(
            description: 'Path to the field that caused the error',
            example: 'user.email',
            nullable: true,
        )]
        public ?string $path = null,
        #[OA\Property(
            description: 'Additional error details',
            example: ['field' => 'email', 'constraint' => 'required'],
        )]
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
