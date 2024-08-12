<?php

namespace Phluent\Tests;

use PHPUnit\Framework\AssertionFailedError;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\TestWith;
use PHPUnit\Framework\TestCase;

use function Phluent\Expect;

class ToBeGreaterThanTest extends TestCase
{
    #[Test]
    #[TestWith([5, 4])]
    #[TestWith([5.8, 4])]
    #[TestWith([5, 4.5])]
    #[TestWith([5.8, 4.5])]
    public function passes_when_expecting_the_actual_value_to_be_greater_than_the_expected_value_and_it_is(int|float $value, int|float $expected): void
    {
        // ACT & ASSERT
        Expect($value)->toBeGreaterThan($expected);
    }

    #[Test]
    #[TestWith([3, 4])]
    #[TestWith([3.3, 4])]
    #[TestWith([3, 4.5])]
    #[TestWith([3.3, 4.5])]
    public function fails_when_expecting_actual_value_to_be_greater_than_expected_value_but_it_is_not(int|float $value, int|float $expected): void
    {
        // ASSERT
        $this->expectException(AssertionFailedError::class);

        // ACT
        Expect($value)->toBeGreaterThan($expected);
    }

    #[Test]
    #[TestWith([4, 5])]
    #[TestWith([4.4, 5])]
    #[TestWith([4, 5.5])]
    #[TestWith([4.4, 5.5])]
    public function passes_when_expecting_actual_value_not_to_be_greater_than_expected_value_and_it_is_not(int|float $value, int|float $expected): void
    {
        // ACT & ASSERT
        Expect($value)->not()->toBeGreaterThan($expected);
    }

    #[Test]
    #[TestWith([6, 3])]
    #[TestWith([6.6, 3])]
    #[TestWith([6, 3.3])]
    #[TestWith([6.6, 3.3])]
    public function fails_when_expecting_actual_value_not_to_be_greater_than_expected_value_but_it_is(int|float $value, int|float $expected): void
    {
        // ASSERT
        $this->expectException(AssertionFailedError::class);

        // ACT
        Expect($value)->not()->toBeGreaterThan($expected);
    }
}
