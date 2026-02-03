<?php

declare(strict_types=1);

namespace Keystone\Shared\Application\Response\Meta;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'AppMeta',
    required: ['requestId', 'timestamp'],
    properties: [
        new OA\Property(
            property: 'requestId',
            description: 'Unique request identifier',
            type: 'string',
            example: '550e8400-e29b-41d4-a716-446655440000',
        ),
        new OA\Property(
            property: 'timestamp',
            description: 'Timestamp of the request in ISO 8601 format',
            type: 'string',
            example: '2026-02-03T18:30:58+01:00',
        ),
    ],
    type: 'object',
)]
final readonly class AppMeta extends BaseMeta
{
}
