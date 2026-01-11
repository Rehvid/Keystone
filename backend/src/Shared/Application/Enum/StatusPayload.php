<?php

declare(strict_types=1);

namespace Keystone\Shared\Application\Enum;

enum StatusPayload: string
{
    case SUCCESS = 'SUCCESS';
    case SUCCESS_EMPTY = 'SUCCESS_EMPTY';
    case ERROR = 'ERROR';
}
