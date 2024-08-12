<?php

namespace Phluent\Tests;

use PHPUnit\Framework\AssertionFailedError;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\TestWith;
use PHPUnit\Framework\TestCase;

use function Phluent\Expect;

class ToBeLessThanTest extends TestCase
{
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

}
