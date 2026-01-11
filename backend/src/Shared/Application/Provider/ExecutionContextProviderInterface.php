<?php

declare(strict_types=1);

namespace Keystone\Shared\Application\Provider;

use Keystone\Shared\Application\ValueObject\ExecutionContext;

interface ExecutionContextProviderInterface
{
    public function load(): ExecutionContext;
}
