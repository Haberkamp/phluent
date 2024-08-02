<?php

namespace Phluent\Tests;

use PHPUnit\Framework\AssertionFailedError;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\TestWith;
use PHPUnit\Framework\TestCase;
use function Phluent\Expect;

class NullAssertionTest extends TestCase
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
    #[TestWith([false])]
    #[TestWith([true])]
    #[TestWith([''])]
    #[TestWith(['some-string'])]
    #[TestWith([0])]
    #[TestWith([1])]
    #[TestWith([[]])]
    public function fails_when_expecting_null_and_not_getting_null(mixed $value): void
    {
       // ASSERT
       $this->expectException(AssertionFailedError::class);

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

       // ACT
       Expect($value)->not()->toBeNull();
    }
}
