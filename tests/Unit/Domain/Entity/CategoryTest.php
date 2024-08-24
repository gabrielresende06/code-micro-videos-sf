<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\Entity;

use Core\Domain\Entity\Category;
use PHPUnit\Framework\TestCase;

class CategoryTest extends TestCase {

    public function testAttributes()
    {
        $category = new Category(
            name: 'New Category',
            description: 'New desc',
            isActive: true
        );

        $this->assertEquals('New Category', $category->name);
        $this->assertEquals('New desc', $category->description);
        $this->assertTrue( $category->isActive);

    }

    public function testActivated()
    {
        $category = new Category(
            name: 'New Cat',
            isActive: false,
        );

        $this->assertFalse($category->isActive);
        $category->activate();
        $this->assertTrue($category->isActive);
    }

    public function testDeactivation()
    {
        $category = new Category(
            name: 'New Category',
        );
        $this->assertTrue($category->isActive);
        $category->deactivate();
        $this->assertFalse($category->isActive);
    }

}