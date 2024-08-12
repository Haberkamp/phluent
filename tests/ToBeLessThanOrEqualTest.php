<?php

namespace Phluent\Tests;

use PHPUnit\Framework\AssertionFailedError;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\TestWith;
use PHPUnit\Framework\TestCase;

use function Phluent\Expect;

class ToBeLessThanOrEqualTest extends TestCase
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
    #[TestWith([6, 5, 'Expected 6 to be less than or equal to 5, but it\'s not.'])]
    #[TestWith([6.6, 5, 'Expected 6.6 to be less than or equal to 5, but it\'s not.'])]
    #[TestWith([6, 5.5, 'Expected 6 to be less than or equal to 5.5, but it\'s not.'])]
    #[TestWith([6.6, 5.5, 'Expected 6.6 to be less than or equal to 5.5, but it\'s not.'])]
    public function fails_when_expecting_value_to_be_less_or_equal_than_expected_value_and_it_is_not(int|float $value, int|float $expected, string $message): void
    {
        // ASSERT
        $this->expectException(AssertionFailedError::class);
        $this->expectExceptionMessage($message);

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
    #[TestWith([5, 5, 'Expected 5 not to be less than or equal to 5, but it is.'])]
    #[TestWith([4, 5, 'Expected 4 not to be less than or equal to 5, but it is.'])]
    #[TestWith([4.5, 5, 'Expected 4.5 not to be less than or equal to 5, but it is.'])]
    #[TestWith([5.5, 5.5, 'Expected 5.5 not to be less than or equal to 5.5, but it is.'])]
    #[TestWith([4, 5.5, 'Expected 4 not to be less than or equal to 5.5, but it is.'])]
    #[TestWith([4.5, 5.5, 'Expected 4.5 not to be less than or equal to 5.5, but it is.'])]
    public function fails_when_expecting_value_not_to_be_less_than_or_equal_to_expected_value_but_it_is_not(int|float $value, int|float $expected, string $message): void
    {
        // ASSERT
        $this->expectException(AssertionFailedError::class);
        $this->expectExceptionMessage($message);

        // ACT
        Expect($value)->not()->toBeLessThanOrEqual($expected);
    }
}
