<?php

declare(strict_types=1);

namespace Keystone\Identity\User\Infrastructure\Persistence\Doctrine\Persister;

use Keystone\Identity\User\Application\Persister\UserPersisterInterface;
use Keystone\Identity\User\Domain\Entity\User;
use Keystone\Identity\User\Infrastructure\Persistence\Doctrine\Repository\WriteRepository;

final class UserPersister implements UserPersisterInterface
{
    public function __construct(
        private WriteRepository $repository,
    ) {
    }

    public function save(User $user): void
    {
        $this->repository->persist($user);
        $this->repository->flush();
    }
}
