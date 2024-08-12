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
    #[TestWith([-2, -1, 5, 'Expected -2 to be in between -1 and 5, but it is not.'])]
    #[TestWith([-2.2, -1, 5, 'Expected -2.2 to be in between -1 and 5, but it is not.'])]
    #[TestWith([6, -1, 5, 'Expected 6 to be in between -1 and 5, but it is not.'])]
    #[TestWith([6.6, -1, 5, 'Expected 6.6 to be in between -1 and 5, but it is not.'])]
    #[TestWith([-2, -1, 5.5, 'Expected -2 to be in between -1 and 5.5, but it is not.'])]
    #[TestWith([-2, -1.1, 5.5, 'Expected -2 to be in between -1.1 and 5.5, but it is not.'])]
    public function fails_when_expecting_value_to_be_between_two_numbers_and_it_is_not(int|float $value, int|float $start, int|float $end, string $message): void
    {
        // ASSERT
        $this->expectException(AssertionFailedError::class);
        $this->expectExceptionMessage($message);

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
    #[TestWith([5, 4, 6, 'Expected 5 not to be in between 4 and 6, but it is.'])]
    #[TestWith([4.4, 4, 6, 'Expected 4.4 not to be in between 4 and 6, but it is.'])]
    #[TestWith([5, 4.5, 6, 'Expected 5 not to be in between 4.5 and 6, but it is.'])]
    #[TestWith([5, 4, 6.5, 'Expected 5 not to be in between 4 and 6.5, but it is.'])]
    public function fails_when_expecting_value_not_to_be_in_between_to_numbers_but_it_is(int|float $value, int|float $start, int|float $end, string $message): void
    {
        // ASSERT
        $this->expectException(AssertionFailedError::class);
        $this->expectExceptionMessage($message);

        // ACT
        Expect($value)->not()->toBeInBetween($start, $end);
    }
}
