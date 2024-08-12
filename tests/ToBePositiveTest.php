<?php

namespace Phluent\Tests;

use PHPUnit\Framework\AssertionFailedError;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\TestWith;
use PHPUnit\Framework\TestCase;

use function Phluent\Expect;

class ToBePositiveTest extends TestCase
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
}
