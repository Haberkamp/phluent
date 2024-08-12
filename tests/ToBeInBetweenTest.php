<?php

namespace Phluent\Tests;

use PHPUnit\Framework\AssertionFailedError;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\TestWith;
use PHPUnit\Framework\TestCase;

use function Phluent\Expect;

class ToBeInBetweenTest extends TestCase
{
    #[Test]
    #[TestWith([5, 1, 10])]
    #[TestWith([5.8, 1, 10])]
    #[TestWith([5, 1.5, 10])]
    #[TestWith([5.8, 1, 10.5])]
    public function passes_when_expecting_value_to_be_between_two_numbers_and_it_is(int|float $value, int|float $start, int|float $end): void
    {
        // ACT & ASSERT
        Expect($value)->toBeInBetween($start, $end);
    }

    #[Test]
    #[TestWith([-2, -1, 5])]
    #[TestWith([-2.2, -1, 5])]
    #[TestWith([6, -1, 5])]
    #[TestWith([6.6, -1, 5])]
    #[TestWith([-2, -1, 5.5])]
    #[TestWith([-2, -1.1, 5.5])]
    public function fails_when_expecting_value_to_be_between_two_numbers_and_it_is_not(int|float $value, int|float $start, int|float $end): void
    {
        // ASSERT
        $this->expectException(AssertionFailedError::class);

        // ACT
        Expect($value)->toBeInBetween($start, $end);
    }

    #[Test]
    #[TestWith([-5, -4, 9])]
    #[TestWith([-5.5, -4, 9])]
    #[TestWith([10, -4, 9])]
    #[TestWith([10.1, -4, 9])]
    #[TestWith([-5, -4.5, 9])]
    #[TestWith([-5, -4, 9.1])]
    public function passes_when_expecting_value_not_be_be_in_between_two_numbers_and_it_is_not(int|float $value, int|float $start, int|float $end): void
    {
        // ACT & ASSERT
        Expect($value)->not()->toBeInBetween($start, $end);
    }

    #[Test]
    #[TestWith([5, 4, 6])]
    #[TestWith([4.4, 4, 6])]
    #[TestWith([5, 4.5, 6])]
    #[TestWith([5, 4, 6.5])]
    public function fails_when_expecting_value_not_to_be_in_between_to_numbers_but_it_is(int|float $value, int|float $start, int|float $end): void
    {
        // ASSERT
        $this->expectException(AssertionFailedError::class);

        // ACT
        Expect($value)->not()->toBeInBetween($start, $end);
    }
}
