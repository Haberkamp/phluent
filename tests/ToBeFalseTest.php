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
        // TODO: assert assertion message
        $this->expectException(AssertionFailedError::class);

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

        // ACT
        Expect($value)->not()->toBeFalse();
    }
}
