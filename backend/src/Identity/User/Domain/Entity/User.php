<?php

declare(strict_types=1);

namespace Keystone\Identity\User\Domain\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use Keystone\Shared\Domain\ValueObject\Email;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Uid\Uuid;

#[Table(name: 'users')]
#[Entity]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[Id]
    #[Column(type: UuidType::NAME, unique: true)]
    private Uuid $id;

    #[Column(type: 'email_type', length: 255, unique: true)]
    private Email $email;

    #[Column(type: Types::STRING, length: 255)]
    private string $password;

    /** @var array<string> $roles */
    #[Column(type: Types::JSON)]
    private array $roles;

    #[Column(type: Types::DATE_IMMUTABLE, nullable: false)]
    private \DateTimeImmutable $createdAt;

    #[Column(type: Types::DATE_IMMUTABLE, nullable: false)]
    private \DateTimeImmutable $updatedAt;

    /**
     * @param array<string> $roles
     */
    public function __construct(Email $email, string $password, array $roles = [])
    {
        $this->id = Uuid::v7();
        $this->email = $email;
        $this->password = $password;
        $this->roles = $roles;
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function getUserIdentifier(): string
    {
        /* @phpstan-ignore-next-line */
        return $this->email->value();
    }

    public function getEmail(): Email
    {
        return $this->email;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): \DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function eraseCredentials(): void
    {
    }
}
