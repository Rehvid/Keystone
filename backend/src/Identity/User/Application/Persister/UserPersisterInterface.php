<?php

declare(strict_types=1);

namespace Keystone\Identity\User\Application\Persister;

use Keystone\Identity\User\Domain\Entity\User;

interface UserPersisterInterface
{
    public function save(User $user): void;
}
