<?php

namespace Phluent\Tests;

use PHPUnit\Framework\AssertionFailedError;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\TestWith;
use PHPUnit\Framework\TestCase;

use function Phluent\Expect;

class ToBeAnArrayTest extends TestCase
{
    #[Test]
    public function passes_when_expecting_value_to_be_an_array_and_it_is_one(): void
    {
        // ARRANGE
        $value = [];

        // ACT & ASSERT
        Expect($value)->toBeAnArray();
    }

    #[Test]
    #[TestWith(['foo', 'Expected value to be an array, got \'foo\'.'])]
    #[TestWith([1, 'Expected value to be an array, got 1.'])]
    #[TestWith([1.1, 'Expected value to be an array, got 1.1.'])]
    #[TestWith([true, 'Expected value to be an array, got true.'])]
    #[TestWith([false, 'Expected value to be an array, got false.'])]
    #[TestWith([null, 'Expected value to be an array, got null.'])]
    public function fails_when_expecting_value_to_be_an_array_and_it_is_not_one(mixed $value, string $message): void
    {
        // ASSERT
        $this->expectException(AssertionFailedError::class);
        $this->expectExceptionMessage($message);

        // ACT
        Expect($value)->toBeAnArray();
    }

    #[Test]
    #[TestWith(['foo'])]
    #[TestWith([1])]
    #[TestWith([1.1])]
    #[TestWith([true])]
    #[TestWith([false])]
    #[TestWith([null])]
    #[TestWith([new \stdClass()])]
    public function passes_when_expecting_value_not_to_be_an_array_and_it_is_not_an_array(mixed $value): void
    {
        // ACT & ASSERT
        Expect($value)->not()->toBeAnArray();
    }

    #[Test]
    public function fails_when_expecting_value_not_to_be_an_array_but_it_is_one(): void
    {
        // ARRANGE
        $value = [];

        // ASSERT
        $this->expectException(AssertionFailedError::class);
        $this->expectExceptionMessage('Expected value not to be an array, got Array &0 [].');

        // ACT
        Expect($value)->not()->toBeAnArray();
    }
}
