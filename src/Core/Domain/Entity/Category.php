<?php

namespace Core\Domain\Entity;

use Core\Domain\Entity\Traits\MagicMethods;

class Category
{
    use MagicMethods;

    public function __construct(
        protected string $name,
        protected ?string $id = '',
        protected string $description = '',
        protected bool $isActive = true
    ) {
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
}