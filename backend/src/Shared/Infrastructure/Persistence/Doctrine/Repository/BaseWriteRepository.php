<?php

declare(strict_types=1);

namespace Keystone\Shared\Infrastructure\Persistence\Doctrine\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @template T of object
 *
 * @extends ServiceEntityRepository<T>
 *
 **/
abstract class BaseWriteRepository extends ServiceEntityRepository
{
    public function persist(object $entity): void
    {
        $this->getEntityManager()->persist($entity);
    }

    public function remove(object $entity): void
    {
        $this->getEntityManager()->remove($entity);
    }

    public function detach(object $entity): void
    {
        $this->getEntityManager()->detach($entity);
    }

    public function flush(): void
    {
        $this->getEntityManager()->flush();
    }
}
