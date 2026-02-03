<?php

declare(strict_types=1);

namespace Keystone\Shared\Application\Response;

use Keystone\Shared\Application\Enum\StatusPayload;
use Keystone\Shared\Application\Response\Error\ErrorPayload;
use Keystone\Shared\Application\Response\Meta\AppMeta;
use Keystone\Shared\Application\Response\Meta\MetaPayloadInterface;
use Nelmio\ApiDocBundle\Attribute\Model;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'AppPayload',
    required: ['status', 'meta'],
    type: 'object',
)]
final readonly class AppPayload
{
    public function __construct(
        #[OA\Property(ref: new Model(type: StatusPayload::class))]
        public StatusPayload $status,
        #[OA\Property(ref: new Model(type: AppMeta::class))]
        public MetaPayloadInterface $metaPayload,
        #[OA\Property(description: 'The actual response data', type: 'object', nullable: true)]
        public mixed $data = null,
        #[OA\Property(ref: new Model(type: ErrorPayload::class), nullable: true)]
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
