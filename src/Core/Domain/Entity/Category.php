<?php

namespace Core\Domain\Entity;

use Core\Domain\Entity\Traits\MagicMethods;
use Core\Domain\Exception\EntityValidationException;
use Core\Domain\Validation\DomainValidation;
use Core\Domain\ValueObject\Uuid;

class Category
{
    use MagicMethods;

    public function __construct(
        protected string $name,
        protected Uuid|string $id = '',
        protected string $description = '',
        protected bool $isActive = true
    ) {
        $this->id = $this->id ? new Uuid($this->id) : Uuid::random();
        $this->validate();
    }

    public function activate(): self
    {
        $this->isActive = true;
        return $this;
    }
    public function deactivate(): self
    {
        $this->isActive = false;
        return $this;
    }

    public function update(
        string $name,
        ?string $description = null
    ): self {
        $this->name = $name;
        $this->description = $description ?? $this->description;
        $this->validate();
        return $this;
    }

    /**
     * @throws EntityValidationException
     */
    public function validate()
    {
        DomainValidation::notNull($this->name, exceptionMessage: 'Invalid name.');
        DomainValidation::strMaxLength($this->name, exceptionMessage: 'Invalid name.');
        DomainValidation::strMinLength($this->name, exceptionMessage: 'Invalid name.');
        DomainValidation::strCanBeNullAndMaxLength($this->description, exceptionMessage: 'Invalid description.');
    }
}