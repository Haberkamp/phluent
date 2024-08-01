<?php

namespace Phluent\Tests;

use PHPUnit\Framework\AssertionFailedError;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use function Phluent\Expect;

class BooleanAssertionTest extends TestCase
{
    #[Test]
    public function passes_when_expecting_true_and_getting_true(): void
    {
        // ARRANGE
        $value = true;

        // ACT & ASSERT
        Expect($value)->toBeTrue();
    }

    #[Test]
    public function fails_when_expecting_true_and_getting_false(): void
    {
        // ARRANGE
        $value = false;

        // ASSERT
        // TODO: assert assertion message
        $this->expectException(AssertionFailedError::class);

        // ACT
        Expect($value)->toBeTrue();
    }
}
