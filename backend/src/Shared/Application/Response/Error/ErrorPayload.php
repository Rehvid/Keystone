<?php

declare(strict_types=1);

namespace Keystone\Shared\Application\Response\Error;

use Nelmio\ApiDocBundle\Attribute\Model;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'ErrorPayload',
    required: ['code', 'message'],
    type: 'object',
)]
final readonly class ErrorPayload
{
    /** @param ErrorDetail[] $details */
    public function __construct(
        #[OA\Property(
            description: 'Main error code',
            example: 'AUTH_INVALID_CREDENTIALS',
        )]
        public string $code,
        #[OA\Property(
            description: 'Main error message',
            example: 'Request validation failed',
        )]
        public string $message,
        #[OA\Property(
            description: 'Detailed list of validation errors',
            type: 'array',
            items: new OA\Items(ref: new Model(type: ErrorDetail::class)),
        )]
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
