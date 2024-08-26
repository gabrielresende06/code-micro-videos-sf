<?php

declare(strict_types=1);

namespace Core\Domain\ValueObject;

use Ramsey\Uuid\Uuid as RamseyUuid;

class Uuid
{

    public function __construct(
        protected string $value
    ) {
        $this->ensureIsValid();
    }

    public static function random(): self
    {
        return new self(RamseyUuid::uuid4()->toString());
    }

    public function __toString(): string
    {
        return $this->value;
    }

    protected function ensureIsValid(): void
    {
        if (!RamseyUuid::isValid($this->value)) {
            throw new \InvalidArgumentException(
                sprintf(
                    '<%s> does not allow the value <%s>.',
                    static::class,
                    $this->value
                )
            );
        }
    }
}