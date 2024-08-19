<?php

namespace Phluent\Tests;

use PHPUnit\Framework\AssertionFailedError;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\TestWith;
use PHPUnit\Framework\TestCase;

use function Phluent\Expect;

class ToBeNullTest extends TestCase
{
    #[Test]
    public function passes_when_expecting_null_and_getting_null(): void
    {
        // ARRANGE
        $value = null;

        // ACT & ASSERT
        Expect($value)->toBeNull();
    }

    #[Test]
    #[TestWith([false, 'Expected value to be null, got false.'])]
    #[TestWith([true, 'Expected value to be null, got true.'])]
    #[TestWith(['', 'Expected value to be null, got \'\''])]
    #[TestWith(['some-string', 'Expected value to be null, got \'some-string\''])]
    #[TestWith([0, 'Expected value to be null, got 0.'])]
    #[TestWith([1, 'Expected value to be null, got 1.'])]
    #[TestWith([[], 'Expected value to be null, got Array (0) [].'])]
    public function fails_when_expecting_null_and_not_getting_null(mixed $value, string $message): void
    {
        // ASSERT
        $this->expectException(AssertionFailedError::class);
        $this->expectExceptionMessage($message);

        // ACT
        Expect($value)->toBeNull();
    }

    #[Test]
    #[TestWith([false])]
    #[TestWith([true])]
    #[TestWith([''])]
    #[TestWith(['some-string'])]
    #[TestWith([0])]
    #[TestWith([1])]
    #[TestWith([[]])]
    #[TestWith([new \stdClass()])]
    public function passes_when_not_expecting_null_and_not_getting_null(mixed $value): void
    {
        // ACT & ASSERT
        Expect($value)->not()->toBeNull();
    }

    #[Test]
    public function fails_when_not_expecting_null_and_getting_null(): void
    {
        // ARRANGE
        $value = null;

        // ASSERT
        $this->expectException(AssertionFailedError::class);
        $this->expectExceptionMessage('Expected value not to be null, got null.');

        // ACT
        Expect($value)->not()->toBeNull();
    }
}
