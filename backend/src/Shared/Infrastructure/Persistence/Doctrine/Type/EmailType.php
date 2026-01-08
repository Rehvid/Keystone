<?php

declare(strict_types=1);

namespace Keystone\Shared\Infrastructure\Persistence\Doctrine\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;
use Keystone\Shared\Domain\ValueObject\Email;

final class EmailType extends StringType
{
    public const string NAME = 'email_type';

    public function convertToDatabaseValue($value, AbstractPlatform $platform): mixed
    {
        if ($value instanceof Email) {
            return $value->value();
        }

        return $value;
    }

    /**
     * @phpstan-param Email|string|null $value
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): ?Email
    {
        if (null === $value || $value instanceof Email) {
            return $value;
        }

        /* @var string $value */
        return new Email($value);
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }

    public function getName(): string
    {
        return self::NAME;
    }
}
