<?php

namespace Phluent\Tests;

use PHPUnit\Framework\AssertionFailedError;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

use function Phluent\Expect;

class ToEndWithTest extends TestCase
{

    #[Test]
    public function passes_when_expecting_string_to_end_with_suffix_and_it_does(): void
    {
        // ARRANGE
        $value = 'Hello, world!';

        // ACT & ASSERT
        Expect($value)->toEndWith('world!');
    }

    #[Test]
    public function fails_when_expecting_string_to_end_with_suffix_but_it_ends_with_different_suffix(): void
    {
        // ARRANGE
        $value = 'Hello, world!';

        // ASSERT
        $this->expectException(AssertionFailedError::class);

        // ACT
        Expect($value)->toEndWith('world');
    }

    #[Test]
    public function passes_when_expecting_string_not_to_end_with_suffix_and_it_does_not(): void
    {
        // ARRANGE
        $value = 'Hello, world!';

        // ACT & ASSERT
        Expect($value)->not()->toEndWith('world');
    }

    #[Test]
    public function fails_when_expecting_string_not_to_end_with_suffix_but_it_does(): void
    {
        // ARRANGE
        $value = 'Hello, world!';

        // ASSERT
        $this->expectException(AssertionFailedError::class);

        // ACT
        Expect($value)->not()->toEndWith('world!');
    }
}
