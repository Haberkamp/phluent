<?php

namespace Phluent\Tests;

use PHPUnit\Framework\AssertionFailedError;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\TestWith;
use PHPUnit\Framework\TestCase;

use function Phluent\Expect;

class IntegerAssertionTest extends TestCase
{
    #[Test]
    public function test_passes_when_expecting_an_integer_and_getting_one(): void
    {
        // ARRANGE
        $value = 1;

        // ACT & ASSERT
        Expect($value)->toBeAnInteger();
    }

    #[Test]
    #[DataProvider('provideNonIntegerValues')]
    public function test_fails_when_expecting_an_integer_and_not_getting_one(mixed $value): void
    {
        // ASSERT
        $this->expectException(AssertionFailedError::class);

        // ACT
        Expect($value)->toBeAnInteger();
    }

    #[Test]
    #[DataProvider('provideNonIntegerValues')]
    public function test_passes_when_not_expecting_an_integer_value_and_not_getting_one(mixed $value): void
    {
        // ACT & ASSERT
        Expect($value)->not()->toBeAnInteger();
    }

    #[Test]
    public function test_fails_when_not_expecting_an_integer_but_getting_one(): void
    {
        // ARRANGE
        $value = 1;

        // ASSERT
        $this->expectException(AssertionFailedError::class);

        // ACT
        Expect($value)->not()->toBeAnInteger();
    }

    #[Test]
    public function passes_when_expecting_value_to_be_negative_and_it_is(): void
    {
        // ARRANGE
        $value = -1;

        // ACT & ASSERT
        Expect($value)->toBeNegative();
    }

    #[Test]
    #[TestWith([0])]
    #[TestWith([1])]
    public function fails_when_expecting_value_to_be_negative_but_it_is_not(int $value): void
    {
        // ASSERT
        $this->expectException(AssertionFailedError::class);

        // ACT
        Expect($value)->toBeNegative();
    }

    #[Test]
    #[TestWith([0])]
    #[TestWith([1])]
    public function passes_when_expecting_value_not_to_be_negative_and_it_is(int $value): void
    {
        // ACT & ASSERT
        Expect($value)->not()->toBeNegative();
    }

    #[Test]
    public function fails_when_expecting_value_not_to_be_negative_but_it_is(): void
    {
        // ARRANGE
        $value = -1;

        // ASSERT
        $this->expectException(AssertionFailedError::class);

        // ACT
        Expect($value)->not()->toBeNegative();
    }

    #[Test]
    public function passes_when_expecting_value_to_be_positive_and_it_is(): void
    {
        // ARRANGE
        $value = 1;

        // ACT & ASSERT
        Expect($value)->toBePositive();
    }

    #[Test]
    #[TestWith([0])]
    #[TestWith([-1])]
    public function fails_when_expecting_value_to_be_positive_but_it_is_not(mixed $value): void
    {
        // ASSERT
        $this->expectException(AssertionFailedError::class);

        // ACT
        Expect($value)->toBePositive();
    }

    #[Test]
    #[TestWith([0])]
    #[TestWith([-1])]
    public function passes_when_expecting_value_not_to_be_positive_and_it_is_not(int $value): void
    {
        // ACT & ASSERT
        Expect($value)->not()->toBePositive();
    }

    #[Test]
    public function fails_when_expecting_value_not_to_be_positive_but_it_is(): void
    {
        // ARRANGE
        $value = 1;

        // ASSERT
        $this->expectException(AssertionFailedError::class);

        // ACT
        Expect($value)->not()->toBePositive();
    }

    public static function provideNonIntegerValues(): array
    {
        return [
            [null],
            [true],
            [false],
            ['1'],
            [1.87],
            [[]],
            [new \stdClass()],
        ];
    }
}
