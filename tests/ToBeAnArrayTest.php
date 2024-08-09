<?php

namespace Phluent\Tests;

use PHPUnit\Framework\AssertionFailedError;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

use function Phluent\Expect;

class ToBeAnArrayTest extends TestCase
{
    #[Test]
    public function passes_when_expecting_value_to_be_an_array_and_it_is_one(): void
    {
        // ARRANGE
        $value = [];

        // ACT & ASSERT
        Expect($value)->toBeAnArray();
    }

    #[Test]
    #[DataProvider('provideNonArrayValues')]
    public function fails_when_expecting_value_to_be_an_array_and_it_is_not_one(mixed $value): void
    {
        // ASSERT
        $this->expectException(AssertionFailedError::class);

        // ACT
        Expect($value)->toBeAnArray();
    }

    #[Test]
    #[DataProvider('provideNonArrayValues')]
    public function passes_when_expecting_value_not_to_be_an_array_and_it_is_not_an_array(mixed $value): void
    {
        // ACT & ASSERT
        Expect($value)->not()->toBeAnArray();
    }

    #[Test]
    public function fails_when_expecting_value_not_to_be_an_array_but_it_is_one(): void
    {
        // ARRANGE
        $value = [];

        // ASSERT
        $this->expectException(AssertionFailedError::class);

        // ACT
        Expect($value)->not()->toBeAnArray();
    }

    public static function provideNonArrayValues(): array
    {
        return [
            ['foo'],
            [1],
            [1.1],
            [true],
            [false],
            [null],
            [new \stdClass()],
        ];
    }
}
