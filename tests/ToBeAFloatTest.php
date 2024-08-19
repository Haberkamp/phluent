<?php

namespace Phluent\Tests;

use PHPUnit\Framework\AssertionFailedError;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\TestWith;
use PHPUnit\Framework\TestCase;

use function Phluent\Expect;

class ToBeAFloatTest extends TestCase
{
    #[Test]
    public function passes_when_expecting_float_and_getting_one(): void
    {
        // ARRANGE
        $value = 1.87;

        // ACT & ASSERT
        Expect($value)->toBeAFloat();
    }

    #[Test]
    #[TestWith([null, 'Expected null to be a float, but it is not.'])]
    #[TestWith([true, 'Expected true to be a float, but it is not.'])]
    #[TestWith([false, 'Expected false to be a float, but it is not.'])]
    #[TestWith(['', 'Expected \'\' to be a float, but it is not.'])]
    #[TestWith(['1.87', 'Expected \'1.87\' to be a float, but it is not.'])]
    #[TestWith(['1', 'Expected \'1\' to be a float, but it is not.'])]
    #[TestWith([1, 'Expected 1 to be a float, but it is not.'])]
    #[TestWith([0, 'Expected 0 to be a float, but it is not.'])]
    #[TestWith([[], 'Expected Array (0) [] to be a float, but it is not.'])]
    public function fails_when_expecting_a_float_and_not_getting_one(mixed $value, string $message): void
    {
        // ASSERT
        $this->expectException(AssertionFailedError::class);
        $this->expectExceptionMessage($message);

        // ACT
        Expect($value)->toBeAFloat();
    }

    #[Test]
    #[TestWith([null])]
    #[TestWith([true])]
    #[TestWith([false])]
    #[TestWith([''])]
    #[TestWith(['1.87'])]
    #[TestWith(['1'])]
    #[TestWith([1])]
    #[TestWith([0])]
    #[TestWith([[]])]
    #[TestWith([new \stdClass()])]
    public function passes_when_not_expecting_a_float_value_and_not_getting_one(mixed $value): void
    {
        // ACT & ASSERT
        Expect($value)->not()->toBeAFloat();
    }

    #[Test]
    public function fails_when_not_expecting_a_float_but_getting_one(): void
    {
        // ARRANGE
        $value = 1.87;

        // ASSERT
        $this->expectException(AssertionFailedError::class);
        $this->expectExceptionMessage('Expected 1.87 not to be a float, but it is.');

        // ACT
        Expect($value)->not()->toBeAFloat();
    }
}
