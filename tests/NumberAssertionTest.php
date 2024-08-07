<?php

namespace Phluent\Tests;

use PHPUnit\Framework\AssertionFailedError;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\TestWith;
use PHPUnit\Framework\TestCase;

use function Phluent\Expect;

class NumberAssertionTest extends TestCase
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
    #[TestWith([-1])]
    #[TestWith([-1.1])]
    public function passes_when_expecting_value_to_be_negative_and_it_is(int|float $value): void
    {
        // ACT & ASSERT
        Expect($value)->toBeNegative();
    }

    #[Test]
    #[TestWith([0])]
    #[TestWith([1])]
    #[TestWith([1.1])]
    public function fails_when_expecting_value_to_be_negative_but_it_is_not(int|float $value): void
    {
        // ASSERT
        $this->expectException(AssertionFailedError::class);

        // ACT
        Expect($value)->toBeNegative();
    }

    #[Test]
    #[TestWith([5])]
    #[TestWith([5.8])]
    public function passes_when_expecting_value_to_be_between_two_numbers_and_it_is(int|float $value): void
    {
        // ACT & ASSERT
        Expect($value)->toBeInBetween(1, 10);
    }

    #[Test]
    #[TestWith([-2])]
    #[TestWith([-2.2])]
    #[TestWith([6])]
    #[TestWith([6.6])]
    public function fails_when_expecting_value_to_be_between_two_numbers_and_it_is_not(int|float $value): void
    {
        // ASSERT
        $this->expectException(AssertionFailedError::class);

        // ACT
        Expect($value)->toBeInBetween(-1, 5);
    }

    #[Test]
    #[TestWith([-5])]
    #[TestWith([-5.5])]
    #[TestWith([10])]
    #[TestWith([10.1])]
    public function passes_when_expecting_value_not_be_be_in_between_two_numbers_and_it_is_not(int|float $value): void
    {
        // ACT & ASSERT
        Expect($value)->not()->toBeInBetween(-4, 9);
    }

    #[Test]
    #[TestWith([5])]
    #[TestWith([4.4])]
    public function fails_when_expecting_value_not_to_be_in_between_to_numbers_but_it_is(int|float $value): void
    {
        // ASSERT
        $this->expectException(AssertionFailedError::class);

        // ACT
        Expect($value)->not()->toBeInBetween(4, 6);
    }

    #[Test]
    #[TestWith([0])]
    #[TestWith([1])]
    #[TestWith([1.1])]
    public function passes_when_expecting_value_not_to_be_negative_and_it_is(int|float $value): void
    {
        // ACT & ASSERT
        Expect($value)->not()->toBeNegative();
    }

    #[Test]
    #[TestWith([-1])]
    #[TestWith([-1.1])]
    public function fails_when_expecting_value_not_to_be_negative_but_it_is(int|float $value): void
    {
        // ASSERT
        $this->expectException(AssertionFailedError::class);

        // ACT
        Expect($value)->not()->toBeNegative();
    }

    #[Test]
    #[TestWith([1])]
    #[TestWith([1.1])]
    public function passes_when_expecting_value_to_be_positive_and_it_is(float|int $value): void
    {
        // ACT & ASSERT
        Expect($value)->toBePositive();
    }

    #[Test]
    #[TestWith([0])]
    #[TestWith([-1])]
    #[TestWith([-1.1])]
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
    #[TestWith([-1.1])]
    public function passes_when_expecting_value_not_to_be_positive_and_it_is_not(int|float $value): void
    {
        // ACT & ASSERT
        Expect($value)->not()->toBePositive();
    }

    #[Test]
    #[TestWith([1])]
    #[TestWith([1.1])]
    public function fails_when_expecting_value_not_to_be_positive_but_it_is(int|float $value): void
    {
        // ASSERT
        $this->expectException(AssertionFailedError::class);

        // ACT
        Expect($value)->not()->toBePositive();
    }

    #[Test]
    #[TestWith([5])]
    #[TestWith([5.8])]
    public function passes_when_expecting_the_actual_value_to_be_greater_than_the_expected_value_and_it_is(int|float $value): void
    {
        // ACT & ASSERT
        Expect($value)->toBeGreaterThan(4);
    }

    #[Test]
    #[TestWith([3])]
    #[TestWith([3.3])]
    public function fails_when_expecting_actual_value_to_be_greater_than_expected_value_but_it_is_not(int|float $value): void
    {
        // ASSERT
        $this->expectException(AssertionFailedError::class);

        // ACT
        Expect($value)->toBeGreaterThan(7);
    }

    #[Test]
    #[TestWith([4])]
    #[TestWith([4.4])]
    public function passes_when_expecting_actual_value_not_to_be_greater_than_expected_value_and_it_is_not(int|float $value): void
    {
        // ACT & ASSERT
        Expect($value)->not()->toBeGreaterThan(5);
    }

    #[Test]
    #[TestWith([6])]
    #[TestWith([6.6])]
    public function fails_when_expecting_actual_value_not_to_be_greater_than_expected_value_but_it_is(int|float $value): void
    {
        // ASSERT
        $this->expectException(AssertionFailedError::class);

        // ACT
        Expect($value)->not()->toBeGreaterThan(3);
    }

    #[Test]
    #[TestWith([3])]
    #[TestWith([3.3])]
    public function passes_when_expecting_the_actual_value_to_be_less_than_the_expected_value_and_it_is(int|float $value): void
    {
        // ACT & ASSERT
        Expect($value)->toBeLessThan(5);
    }

    #[Test]
    #[TestWith([7])]
    #[TestWith([7.7])]
    public function fails_when_expecting_actual_value_to_be_less_than_expected_value_but_it_is_not(int|float $value): void
    {
        // ASSERT
        $this->expectException(AssertionFailedError::class);

        // ACT
        Expect($value)->toBeLessThan(5);
    }

    #[Test]
    #[TestWith([5])]
    #[TestWith([5.5])]
    public function passes_when_expecting_actual_value_not_to_be_less_than_expected_value_and_it_is_not(int|float $value): void
    {
        // ACT & ASSERT
        Expect($value)->not()->toBeLessThan(3);
    }

    #[Test]
    #[TestWith([2])]
    #[TestWith([2.2])]
    public function fails_when_expecting_actual_value_not_to_be_less_than_expected_value_but_it_is(int|float $value): void
    {
        // ASSERT
        $this->expectException(AssertionFailedError::class);

        // ACT
        Expect($value)->not()->toBeLessThan(3);
    }

    #[Test]
    public function passes_when_expecting_float_and_getting_one(): void
    {
        // ARRANGE
        $value = 1.87;

        // ACT & ASSERT
        Expect($value)->toBeAFloat();
    }

    #[Test]
    #[DataProvider('provideNonFloatValues')]
    public function fails_when_expecting_a_float_and_not_getting_one(mixed $value): void
    {
        // ASSERT
        $this->expectException(AssertionFailedError::class);

        // ACT
        Expect($value)->toBeAFloat();
    }

    #[Test]
    #[DataProvider('provideNonFloatValues')]
    public function passes_when_not_expecting_a_float_value_and_not_getting_one(mixed $value): void
    {
        // ACT & ASSERT
        Expect($value)->not()->toBeAFloat();
    }

    #[Test]
    public function fails_when_not_expecting_a_float_but_getting_one(): void
    {
        // ARRANGE
        $value = 1.87;

        // ASSERT
        $this->expectException(AssertionFailedError::class);

        // ACT
        Expect($value)->not()->toBeAFloat();
    }

    #[Test]
    #[TestWith([5, 5])]
    #[TestWith([4, 5])]
    #[TestWith([4.5, 5])]
    #[TestWith([5.5, 5.5])]
    #[TestWith([4, 5.5])]
    #[TestWith([4.5, 5.5])]
    public function passes_when_expecting_value_to_be_less_or_equal_than_expected_value_and_it_is(int|float $value, int|float $expected): void
    {
        // ACT & ASSERT
        Expect($value)->toBeLessThanOrEqual($expected);
    }

    #[Test]
    #[TestWith([6, 5])]
    #[TestWith([6.6, 5])]
    #[TestWith([6, 5.5])]
    #[TestWith([6.6, 5.5])]
    public function fails_when_expecting_value_to_be_less_or_equal_than_expected_value_and_it_is_not(int|float $value, int|float $expected): void
    {
        // ASSERT
        $this->expectException(AssertionFailedError::class);

        // ACT
        Expect($value)->toBeLessThanOrEqual($expected);
    }

    #[Test]
    #[TestWith([6, 5])]
    #[TestWith([6.6, 5])]
    #[TestWith([6, 5.5])]
    #[TestWith([6.6, 5.5])]
    public function passes_when_expecting_value_not_to_be_less_or_equal_to_than_expected_value_and_it_is(int|float $value, int|float $expected): void
    {
        // ACT & ASSERT
        Expect($value)->not()->toBeLessThanOrEqual($expected);
    }

    #[Test]
    #[TestWith([5, 5])]
    #[TestWith([4, 5])]
    #[TestWith([4.5, 5])]
    #[TestWith([5.5, 5.5])]
    #[TestWith([4, 5.5])]
    #[TestWith([4.5, 5.5])]
    public function fails_when_expecting_value_not_to_be_less_than_or_equal_to_expected_value_but_it_is_not(int|float $value, int|float $expected): void
    {
        // ASSERT
        $this->expectException(AssertionFailedError::class);

        // ACT
        Expect($value)->not()->toBeLessThanOrEqual($expected);
    }


    public static function provideNonFloatValues(): array
    {
        return [
            [null],
            [true],
            [false],
            [''],
            ['1.87'],
            ['1'],
            [1],
            [0],
            [[]],
            [new \stdClass()],
        ];
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
