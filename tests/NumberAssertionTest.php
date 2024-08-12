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
}
