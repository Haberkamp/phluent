<?php

namespace Phluent\Tests;

use PHPUnit\Framework\AssertionFailedError;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\TestWith;
use PHPUnit\Framework\TestCase;

use function Phluent\Expect;

class NumberAssertionTest extends TestCase
{
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
    #[TestWith([3, 5])]
    #[TestWith([3.3, 5])]
    #[TestWith([3, 5.5])]
    #[TestWith([3.3, 5.5])]
    public function passes_when_expecting_the_actual_value_to_be_less_than_the_expected_value_and_it_is(int|float $value, int|float $expected): void
    {
        // ACT & ASSERT
        Expect($value)->toBeLessThan($expected);
    }

    #[Test]
    #[TestWith([7, 5])]
    #[TestWith([7.7, 5])]
    #[TestWith([7, 5.5])]
    #[TestWith([7.7, 5.5])]
    public function fails_when_expecting_actual_value_to_be_less_than_expected_value_but_it_is_not(int|float $value, int|float $expected): void
    {
        // ASSERT
        $this->expectException(AssertionFailedError::class);

        // ACT
        Expect($value)->toBeLessThan($expected);
    }

    #[Test]
    #[TestWith([5, 3])]
    #[TestWith([5.5, 3])]
    #[TestWith([5, 3.3])]
    #[TestWith([5.5, 3.3])]
    public function passes_when_expecting_actual_value_not_to_be_less_than_expected_value_and_it_is_not(int|float $value, int|float $expected): void
    {
        // ACT & ASSERT
        Expect($value)->not()->toBeLessThan($expected);
    }

    #[Test]
    #[TestWith([2, 3])]
    #[TestWith([2.2, 3])]
    #[TestWith([2, 3.3])]
    #[TestWith([2.2, 3.3])]
    public function fails_when_expecting_actual_value_not_to_be_less_than_expected_value_but_it_is(int|float $value, int|float $expected): void
    {
        // ASSERT
        $this->expectException(AssertionFailedError::class);

        // ACT
        Expect($value)->not()->toBeLessThan($expected);
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

    #[Test]
    #[TestWith([5, 5])]
    #[TestWith([5, 4])]
    #[TestWith([5, 4.5])]
    #[TestWith([5.5, 5.5])]
    #[TestWith([5.5, 4])]
    #[TestWith([5.5, 4.5])]
    public function passes_when_expecting_value_to_be_greater_than_or_equal_to_the_expected_value_and_it_is(int|float $value, int|float $expected): void
    {
        // ACT & ASSERT
        Expect($value)->toBeGreaterThanOrEqual($expected);
    }

    #[Test]
    #[TestWith([5, 6])]
    #[TestWith([5, 6.6])]
    #[TestWith([5.5, 6])]
    #[TestWith([5.5, 6.6])]
    public function fails_when_expecting_value_to_be_greater_than_or_equal_to_the_expected_value_but_less_than_it(int|float $value, int|float $expected): void
    {
        // ASSERT
        $this->expectException(AssertionFailedError::class);

        // ACT
        Expect($value)->toBeGreaterThanOrEqual($expected);
    }

    #[Test]
    #[TestWith([5, 6])]
    #[TestWith([5, 6.6])]
    #[TestWith([5.5, 6])]
    #[TestWith([5.5, 6.6])]
    public function passes_when_expecting_value_not_to_be_greater_than_or_equal_to_the_expected_value_and_it_is_not(int|float $value, int|float $expected): void
    {
        // ACT & ASSERT
        Expect($value)->not()->toBeGreaterThanOrEqual($expected);
    }

    #[Test]
    #[TestWith([5, 5])]
    #[TestWith([5, 4])]
    #[TestWith([5, 4.5])]
    #[TestWith([5.5, 5.5])]
    #[TestWith([5.5, 4])]
    #[TestWith([5.5, 4.5])]
    public function fails_when_expecting_value_not_to_be_greater_than_or_equal_to_the_expected_value_but_it_is(int|float $value, int|float $expected): void
    {
        // ASSERT
        $this->expectException(AssertionFailedError::class);

        // ACT
        Expect($value)->not()->toBeGreaterThanOrEqual($expected);
    }
}
