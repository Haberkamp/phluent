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
    #[TestWith([3, 4, 'Expected 3 to be greater than 4, but it\'s not.'])]
    #[TestWith([3.3, 4, 'Expected 3.3 to be greater than 4, but it\'s not.'])]
    #[TestWith([3, 4.5, 'Expected 3 to be greater than 4.5, but it\'s not.'])]
    #[TestWith([3.3, 4.5, 'Expected 3.3 to be greater than 4.5, but it\'s not.'])]
    public function fails_when_expecting_actual_value_to_be_greater_than_expected_value_but_it_is_not(int|float $value, int|float $expected, string $message): void
    {
        // ASSERT
        $this->expectException(AssertionFailedError::class);
        $this->expectExceptionMessage($message);

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
    #[TestWith([6, 3, 'Expected 6 not to be greater than 3, but it is.'])]
    #[TestWith([6.6, 3, 'Expected 6.6 not to be greater than 3, but it is.'])]
    #[TestWith([6, 3.3, 'Expected 6 not to be greater than 3.3, but it is.'])]
    #[TestWith([6.6, 3.3, 'Expected 6.6 not to be greater than 3.3, but it is.'])]
    public function fails_when_expecting_actual_value_not_to_be_greater_than_expected_value_but_it_is(int|float $value, int|float $expected, string $message): void
    {
        // ASSERT
        $this->expectException(AssertionFailedError::class);
        $this->expectExceptionMessage($message);

        // ACT
        Expect($value)->not()->toBeGreaterThan($expected);
    }
}
