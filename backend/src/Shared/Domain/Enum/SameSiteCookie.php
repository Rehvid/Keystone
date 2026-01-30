<?php

declare(strict_types=1);

namespace Keystone\Shared\Domain\Enum;

enum SameSiteCookie: string
{
    case STRICT = 'strict';
    case LAX = 'lax';
    case NONE = 'none';
}
