<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\Entity;

use Core\Domain\Entity\Category;
use Core\Domain\Exception\EntityValidationException;
use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertEquals;

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

    public function testUpdate()
    {
        $uuid = 'uuid.value';

        $category = new Category(
            name: 'New Category',
            id: $uuid,
            description: 'New desc',
            isActive: true
        );

        $category->update(
            name: 'Updated name',
            description: 'Updated desc'
        );

        $this->assertEquals('Updated name', $category->name);
        $this->assertEquals('Updated desc', $category->description);
    }

    public function testUpdateWithSameDescription()
    {
        $uuid = 'uuid.value';

        $category = new Category(
            name: 'New Category',
            id: $uuid,
            description: 'New desc',
            isActive: true
        );

        $category->update(
            name: 'Updated name',
        );

        $this->assertEquals('Updated name', $category->name);
        $this->assertEquals('New desc', $category->description);
    }

    public function testExceptionName()
    {
        $this->expectException('');
        $this->expectExceptionObject(new EntityValidationException('Invalid name'));
        new Category(
            name: 'Ne',
            description: 'New Desc'
        );
    }
}