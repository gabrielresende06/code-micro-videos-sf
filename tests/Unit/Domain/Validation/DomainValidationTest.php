<?php

namespace Tests\Unit\Domain\Validation;

use Core\Domain\Exception\EntityValidationException;
use Core\Domain\Validation\DomainValidation;
use PHPUnit\Framework\TestCase;

class DomainValidationTest extends TestCase
{

    /**
     * @throws EntityValidationException
     */
    public function testNotNull()
    {
        $this->expectExceptionObject(new EntityValidationException('Should not be empty.'));
        $value = '';
        DomainValidation::notNull($value);
    }

    public function testNotNullCustomExceptionMessage()
    {
        $this->expectExceptionObject(new EntityValidationException('Custom error message.'));
        $value = '';
        DomainValidation::notNull($value, 'Custom error message.');
    }

    /**
     * @throws EntityValidationException
     */
    public function testStrMaxLength()
    {
        $this->expectExceptionObject(new EntityValidationException('Custom error message.'));
        $value = 'Test';
        DomainValidation::strMaxLength($value, 3, 'Custom error message.');
    }

    /**
     * @throws EntityValidationException
     */
    public function testStrMinLength()
    {
        $this->expectExceptionObject(new EntityValidationException('Custom error message.'));
            $value = 'a';
        DomainValidation::strMinLength($value, 2, 'Custom error message.');
    }

    /**
     * @throws EntityValidationException
     */
    public function testStrCanBeNullAndMaxLength(): void
    {
        $this->expectExceptionObject(new EntityValidationException('Custom error message.'));
        $value = 'Test';
        DomainValidation::strCanBeNullAndMaxLength($value, 2, 'Custom error message.');
    }

}