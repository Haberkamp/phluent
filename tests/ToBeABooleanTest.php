<?php

namespace Phluent\Tests;

use PHPUnit\Framework\AssertionFailedError;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

use function Phluent\Expect;

class ToBeABooleanTest extends TestCase
{
    #[Test]
    #[DataProvider('provideBooleanValues')]
    public function passes_when_expecting_a_boolean_value_and_getting_a_boolean_value(bool $value): void
    {
        // ACT & ASSERT
        Expect($value)->toBeABoolean();
    }

    #[Test]
    #[DataProvider('provideNonBooleanValues')]
    public function fails_when_expecting_a_boolean_value_and_not_getting_a_boolean_value(mixed $value): void
    {
        // ASSERT
        $this->expectException(AssertionFailedError::class);

        // ACT
        Expect($value)->toBeABoolean();
    }

    #[Test]
    #[DataProvider('provideNonBooleanValues')]
    public function passes_when_not_expecting_a_boolean_value_and_not_getting_a_boolean_value(mixed $value): void
    {
        // ACT & ASSERT
        Expect($value)->not()->toBeABoolean();
    }

    #[Test]
    #[DataProvider('provideBooleanValues')]
    public function fails_when_not_expecting_a_boolean_value_and_getting_boolean_value(bool $value): void
    {
        // ASSERT
        $this->expectException(AssertionFailedError::class);

        // ACT
        Expect($value)->not()->toBeABoolean();
    }

    public static function provideBooleanValues(): array
    {
        return [
            [true],
            [false],
        ];
    }

    public static function provideNonBooleanValues(): array
    {
        return [
            [1],
            [0],
            ['true'],
            ['false'],
            [null],
            [[]],
        ];
    }
}
