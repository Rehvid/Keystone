<?php

declare(strict_types=1);

namespace Keystone\Shared\Domain\ValueObject;

use Keystone\Shared\Domain\Exception\Email\InvalidEmailFormatException;

final readonly class Email
{
    private string $value;

    public function __construct(string $value)
    {
        $cleanValue = strtolower(trim($value));

        if (!filter_var($cleanValue, FILTER_VALIDATE_EMAIL)) {
            throw InvalidEmailFormatException::create($value);
        }

        $this->value = $cleanValue;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(Email $other): bool
    {
        return $this->value() === $other->value();
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
