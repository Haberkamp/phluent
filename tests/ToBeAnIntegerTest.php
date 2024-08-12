<?php

namespace Phluent\Tests;

use PHPUnit\Framework\AssertionFailedError;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\TestWith;
use PHPUnit\Framework\TestCase;

use function Phluent\Expect;

class ToBeAnIntegerTest extends TestCase
{
    #[Test]
    public function test_passes_when_expecting_an_integer_and_getting_one(): void
    {
        // ARRANGE
        $value = 1;

        // ACT & ASSERT
        Expect($value)->toBeAnInteger();
    }

    #[Test]
    #[TestWith([null, 'Expected value to be an integer, got null.'])]
    #[TestWith([true, 'Expected value to be an integer, got true.'])]
    #[TestWith([false, 'Expected value to be an integer, got false.'])]
    #[TestWith(['1', 'Expected value to be an integer, got \'1\'.'])]
    #[TestWith([1.87, 'Expected value to be an integer, got 1.87.'])]
    #[TestWith([[], 'Expected value to be an integer, got Array &0 [].'])]
    public function test_fails_when_expecting_an_integer_and_not_getting_one(mixed $value, string $message): void
    {
        // ASSERT
        $this->expectException(AssertionFailedError::class);
        $this->expectExceptionMessage($message);

        // ACT
        Expect($value)->toBeAnInteger();
    }

    #[Test]
    #[TestWith([null])]
    #[TestWith([true])]
    #[TestWith([false])]
    #[TestWith(['1'])]
    #[TestWith([1.87])]
    #[TestWith([[]])]
    #[TestWith([new \stdClass()])]
    public function test_passes_when_not_expecting_an_integer_value_and_not_getting_one(mixed $value): void
    {
        // ACT & ASSERT
        Expect($value)->not()->toBeAnInteger();
    }

    #[Test]
    public function test_fails_when_not_expecting_an_integer_but_getting_one(): void
    {
        // ARRANGE
        $value = 1;

        // ASSERT
        $this->expectException(AssertionFailedError::class);
        $this->expectExceptionMessage('Expected value not to be an integer, got 1.');

        // ACT
        Expect($value)->not()->toBeAnInteger();
    }
}
