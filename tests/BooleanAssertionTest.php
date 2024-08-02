<?php

namespace Phluent\Tests;

use PHPUnit\Framework\AssertionFailedError;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\TestWith;
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

    #[Test]
    public function passes_when_expecting_false_and_getting_false()
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
    #[TestWith([true])]
    #[TestWith([false])]
    public function passes_when_expecting_a_boolean_value_and_getting_a_boolean_value(bool $value): void
    {
        // ACT & ASSERT
        Expect($value)->toBeABoolean();
    }
}
