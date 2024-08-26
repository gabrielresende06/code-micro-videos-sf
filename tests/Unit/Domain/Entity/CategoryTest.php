<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\Entity;

use Core\Domain\Entity\Category;
use Core\Domain\Exception\EntityValidationException;
use PHPUnit\Framework\TestCase;

use Ramsey\Uuid\Uuid;

use function PHPUnit\Framework\assertEquals;

class CategoryTest extends TestCase {

    public function testAttributes()
    {
        $category = new Category(
            name: 'New Category',
            description: 'New desc',
            isActive: true
        );

        $this->assertNotEmpty($category->getId());
        $this->assertEquals('New Category', $category->name);
        $this->assertEquals('New desc', $category->description);
        $this->assertTrue( $category->isActive);
        $this->assertNotEmpty($category->createdAt());

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
        $uuid = (string) Uuid::uuid4()->toString();

        $category = new Category(
            name: 'New Category',
            id: $uuid,
            description: 'New desc',
            isActive: true,
            createdAt: '2024-08-26 19:48:00'
        );

        $category->update(
            name: 'Updated name',
            description: 'Updated desc'
        );

        $this->assertEquals($uuid, $category->getId());
        $this->assertEquals('Updated name', $category->name);
        $this->assertEquals('Updated desc', $category->description);
        $this->assertEquals('2024-08-26 19:48:00', $category->createdAt());
    }

    public function testUpdateWithSameDescription()
    {
        $uuid = (string) Uuid::uuid4()->toString();

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
        $this->expectExceptionObject(new EntityValidationException('Invalid name'));
        new Category(
            name: 'Ne',
            description: 'New Desc'
        );
    }

    public function testExceptionDescription()
    {
        $this->expectExceptionObject(new EntityValidationException('Invalid description.'));
        new Category(
            name: 'Category Test',
            description: random_bytes(99999)
        );
    }
}