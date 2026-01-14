<?php

declare(strict_types=1);

namespace Keystone\Identity\User\Infrastructure\Persistence\Doctrine\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Keystone\Identity\User\Domain\Entity\User;

/**
 * @extends ServiceEntityRepository<User>
 */
final class ReadRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }
}
