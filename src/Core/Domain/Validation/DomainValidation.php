<?php

namespace Core\Domain\Validation;

use Core\Domain\Exception\EntityValidationException;

class DomainValidation
{

    /**
     * @throws EntityValidationException
     */
    public static function notNull(
        string $value,
        string $exceptionMessage = null
    ): void {
        if (empty($value)) {
            throw new EntityValidationException($exceptionMessage ?? "Should not be empty.");
        }
    }

    /**
     * @throws EntityValidationException
     */
    public static function strMaxLength(
        string $value,
        int $length = 255,
        string $exceptionMessage = null
    ): void {
        if (strlen($value) >= $length) {
            throw new EntityValidationException(
                $exceptionMessage ?? "The value must not exceed {$length} characters."
            );
        }
    }

    /**
     * @throws EntityValidationException
     */
    public static function strMinLength(
        string $value,
        int $length = 3,
        string $exceptionMessage = null
    ): void {
        if (strlen($value) < $length) {
            throw new EntityValidationException(
                $exceptionMessage ?? "The value must not be less than {$length} characters."
            );
        }
    }

    /**
     * @throws EntityValidationException
     */
    public static function strCanBeNullAndMaxLength(
        string $value = null,
        int $length = 255,
        string $exceptionMessage = null
    ): void {
        if (!empty($value) && strlen($value) > $length) {
            throw new EntityValidationException(
                $exceptionMessage ?? "The value must not be greater than {$length} characters."
            );
        }
    }

}