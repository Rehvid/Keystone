<?php

declare(strict_types=1);

namespace Keystone\Shared\Application\Enum;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'StatusPayloadEnum',
    description: 'Response status type',
    type: 'string',
    enum: ['SUCCESS', 'SUCCESS_EMPTY', 'ERROR'],
    example: 'SUCCESS',
)]
enum StatusPayload: string
{
    case SUCCESS = 'SUCCESS';

    case SUCCESS_EMPTY = 'SUCCESS_EMPTY';

    case ERROR = 'ERROR';
}
