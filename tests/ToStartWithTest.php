<?php

namespace Phluent\Tests;

use PHPUnit\Framework\AssertionFailedError;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

use function Phluent\Expect;

class ToStartWithTest extends TestCase
{
    #[Test]
    public function passes_when_expecting_string_to_start_with_prefix_and_it_does(): void
    {
        // ARRANGE
        $value = 'Hello, world!';

        // ACT & ASSERT
        Expect($value)->toStartWith('Hello');
    }

    #[Test]
    public function fails_when_expecting_string_to_start_with_prefix_but_it_starts_with_different_prefix(): void
    {
        // ARRANGE
        $value = 'Bye, world!';

        // ASSERT
        $this->expectException(AssertionFailedError::class);
        $this->expectExceptionMessage('Expected "Bye, world!" to start with "Hello", but it does not.');

        // ACT
        Expect($value)->toStartWith('Hello');
    }

    #[Test]
    public function passes_when_expecting_string_not_to_start_with_prefix_and_it_does_not(): void
    {
        // ARRANGE
        $value = 'Bye, world!';

        // ACT & ASSERT
        Expect($value)->not()->toStartWith('Hello');
    }

    #[Test]
    public function fails_when_expecting_string_not_to_start_with_prefix_but_it_does(): void
    {
        // ARRANGE
        $value = 'Hello, world!';

        // ASSERT
        $this->expectException(AssertionFailedError::class);
        $this->expectExceptionMessage('Expected "Hello, world!" not to start with "Hello", but it does.');

        // ACT
        Expect($value)->not()->toStartWith('Hello');
    }
}
