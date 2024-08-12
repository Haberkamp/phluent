<?php

namespace Phluent\Tests;

use PHPUnit\Framework\AssertionFailedError;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\TestWith;
use PHPUnit\Framework\TestCase;

use function Phluent\Expect;

class ToBeGreaterThanOrEqualTest extends TestCase
{
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
