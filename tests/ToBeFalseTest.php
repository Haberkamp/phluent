<?php

namespace Phluent\Tests;

use PHPUnit\Framework\AssertionFailedError;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

use function Phluent\Expect;

class ToBeFalseTest extends TestCase
{
    #[Test]
    public function passes_when_expecting_false_and_getting_false(): void
    {
        // ARRANGE
        $value = false;

        // ACT & ASSERT
        Expect($value)->toBeFalse();
    }

    #[Test]
    public function fails_when_expecting_false_and_getting_true(): void
    {
        // ARRANGE
        $value = true;

        // ASSERT
        $this->expectException(AssertionFailedError::class);
        $this->expectExceptionMessage('Expected boolean to be false, got true.');

        // ACT
        Expect($value)->toBeFalse();
    }

    #[Test]
    public function passes_when_not_expecting_false_and_not_getting_false(): void
    {
        // ARRANGE
        $value = true;

        // ACT & ASSERT
        Expect($value)->not()->toBeFalse();
    }

    #[Test]
    public function fails_when_not_expecting_false_and_getting_false(): void
    {
        // ARRANGE
        $value = false;

        // ASSERT
        $this->expectException(AssertionFailedError::class);
        $this->expectExceptionMessage('Expected boolean to be true, got false.');

        // ACT
        Expect($value)->not()->toBeFalse();
    }
}
