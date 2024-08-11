<?php

namespace Phluent\Tests;

use PHPUnit\Framework\AssertionFailedError;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\TestWith;
use PHPUnit\Framework\TestCase;

use function Phluent\Expect;

class ToBeABooleanTest extends TestCase
{
    #[Test]
    #[TestWith([true])]
    #[TestWith([false])]
    public function passes_when_expecting_a_boolean_value_and_getting_a_boolean_value(bool $value): void
    {
        // ACT & ASSERT
        Expect($value)->toBeABoolean();
    }

    #[Test]
    #[TestWith([1, 'Expected value to be a boolean, got 1.'])]
    #[TestWith([0, 'Expected value to be a boolean, got 0.'])]
    #[TestWith(['true', 'Expected value to be a boolean, got \'true\'.'])]
    #[TestWith(['false', 'Expected value to be a boolean, got \'false\'.'])]
    #[TestWith([null, 'Expected value to be a boolean, got null.'])]
    #[TestWith([[], 'Expected value to be a boolean, got Array &0 [].'])]
    public function fails_when_expecting_a_boolean_value_and_not_getting_a_boolean_value(mixed $value, string $message): void
    {
        // ASSERT
        $this->expectException(AssertionFailedError::class);
        $this->expectExceptionMessage($message);

        // ACT
        Expect($value)->toBeABoolean();
    }

    #[Test]
    #[TestWith([1])]
    #[TestWith([0])]
    #[TestWith(['true'])]
    #[TestWith(['false'])]
    #[TestWith([null])]
    #[TestWith([[]])]
    public function passes_when_not_expecting_a_boolean_value_and_not_getting_a_boolean_value(mixed $value): void
    {
        // ACT & ASSERT
        Expect($value)->not()->toBeABoolean();
    }

    #[Test]
    #[TestWith([true, 'Expected value not to be a boolean, got true.'])]
    #[TestWith([false, 'Expected value not to be a boolean, got false.'])]
    public function fails_when_not_expecting_a_boolean_value_and_getting_boolean_value(bool $value, string $message): void
    {
        // ASSERT
        $this->expectException(AssertionFailedError::class);
        $this->expectExceptionMessage($message);

        // ACT
        Expect($value)->not()->toBeABoolean();
    }
}
