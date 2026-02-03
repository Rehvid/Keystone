<?php

declare(strict_types=1);

namespace Keystone\Identity\Common\Application\Enum;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'AuthenticationErrorCode',
    description: 'Authentication error codes',
    type: 'string',
    enum: [
        'AUTH_INVALID_CREDENTIALS',
        'AUTH_JWT_INVALID_TOKEN',
        'AUTH_JWT_EXPIRED_TOKEN',
        'AUTH_JWT_MISSING_TOKEN',
    ],
    example: 'AUTH_INVALID_CREDENTIALS',
)]
enum AuthenticationErrorCode: string
{
    case INVALID_CREDENTIALS = 'AUTH_INVALID_CREDENTIALS';
    case JWT_EXPIRED_TOKEN = 'AUTH_JWT_EXPIRED_TOKEN';
    case JWT_MISSING_TOKEN = 'AUTH_JWT_MISSING_TOKEN';
    case JWT_INVALID_TOKEN = 'AUTH_JWT_INVALID_TOKEN';
}
