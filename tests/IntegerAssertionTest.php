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
    public function passes_when_expecting_value_to_be_between_two_numbers_and_it_is(): void
    {
        // ARRANGE
        $value = 5;

        // ACT & ASSERT
        Expect($value)->toBeInBetween(1, 10);
    }

    #[Test]
    #[TestWith([-2])]
    #[TestWith([6])]
    public function fails_when_expecting_value_to_be_between_two_numbers_and_it_is_not(int $value): void
    {
        // ASSERT
        $this->expectException(AssertionFailedError::class);

        // ACT
        Expect($value)->toBeInBetween(-1, 5);
    }

    #[Test]
    #[TestWith([-5])]
    #[TestWith([10])]
    public function passes_when_expecting_value_not_be_be_in_between_two_numbers_and_it_is_not(int $value): void
    {
        // ACT & ASSERT
        Expect($value)->not()->toBeInBetween(-4, 9);
    }

    #[Test]
    public function fails_when_expecting_value_not_to_be_in_between_to_numbers_but_it_is(): void
    {
        // ARRANGE
        $value = 5;

        // ASSERT
        $this->expectException(AssertionFailedError::class);

        // ACT
        Expect($value)->not()->toBeInBetween(4, 6);
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

    #[Test]
    public function passes_when_expecting_the_actual_value_to_be_greater_than_the_expected_value_and_it_is(): void
    {
        // ARRANGE
        $value = 5;

        // ACT & ASSERT
        Expect($value)->toBeGreaterThan(4);
    }

    #[Test]
    public function fails_when_expecting_actual_value_to_be_greater_than_expected_value_but_it_is_not(): void
    {
        // ARRANGE
        $value = 3;

        // ASSERT
        $this->expectException(AssertionFailedError::class);

        // ACT
        Expect($value)->toBeGreaterThan(7);
    }

    #[Test]
    public function passes_when_expecting_actual_value_not_to_be_greater_than_expected_value_and_it_is_not(): void
    {
        // ARRANGE
        $value = 4;

        // ACT & ASSERT
        Expect($value)->not()->toBeGreaterThan(5);
    }

    #[Test]
    public function fails_when_expecting_actual_value_not_to_be_greater_than_expected_value_but_it_is(): void
    {
        // ARRANGE
        $value = 8;

        // ASSERT
        $this->expectException(AssertionFailedError::class);

        // ACT
        Expect($value)->not()->toBeGreaterThan(3);
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
