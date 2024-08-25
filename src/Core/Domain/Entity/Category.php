<?php

namespace Core\Domain\Entity;

use Core\Domain\Entity\Traits\MagicMethods;
use Core\Domain\Exception\EntityValidationException;

class Category
{
    use MagicMethods;

    public function __construct(
        protected string $name,
        protected ?string $id = '',
        protected string $description = '',
        protected bool $isActive = true
    ) {
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
        if (empty($this->name)) {
            throw new EntityValidationException("Invalid name");
        }

        if (strlen($this->name) > 255 || strlen($this->name) <= 2) {
            throw new EntityValidationException("Invalid name");
        }

        if (!empty($this->description) && (strlen($this->description) > 255 || strlen($this->description) < 3)) {
            throw new EntityValidationException("Invalid description");
        }
    }
}