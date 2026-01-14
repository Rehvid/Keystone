<?php

declare(strict_types=1);

namespace Keystone\Identity\User\Infrastructure\Persistence\Doctrine\Repository;

use Doctrine\Persistence\ManagerRegistry;
use Keystone\Identity\User\Domain\Entity\User;
use Keystone\Shared\Infrastructure\Persistence\Doctrine\Repository\BaseWriteRepository;

/**
 * @extends BaseWriteRepository<User>
 */
final class WriteRepository extends BaseWriteRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }
}
