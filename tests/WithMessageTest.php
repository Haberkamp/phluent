<?php

namespace Phluent\Tests;

use PHPUnit\Framework\AssertionFailedError;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

use function Phluent\Expect;

class WithMessageTest extends TestCase
{
    #[Test]
    public function passes_when_expecting_certain_exception_message_and_exception_contains_that_message(): void
    {
        // ARRANGE
        $callback = fn () => throw new \InvalidArgumentException('Invalid argument');

        // ACT & ASSERT
        Expect($callback)->toThrow(\InvalidArgumentException::class)->withMessage('Invalid argument');
    }

    #[Test]
    public function fails_when_expecting_certain_exception_message_and_exception_message_is_different(): void
    {
        // ARRANGE
        $callback = fn () => throw new \InvalidArgumentException('Invalid argument');

        // ASSERT
        $this->expectException(AssertionFailedError::class);
        $this->expectExceptionMessage('Expected exception message to be "Different message", but got "Invalid argument".');

        // ACT
        Expect($callback)->toThrow(\InvalidArgumentException::class)->withMessage('Different message');
    }

    #[Test]
    public function it_is_not_possible_to_assert_exception_message_when_expecting_not_an_exception_to_be_thrown(): void
    {
        // ARRANGE
        $callback = fn () => null;

        // ASSERT
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Cannot assert exception message when not expecting an exception to be thrown.');

        // ACT
        Expect($callback)->not()->toThrow()->withMessage('Invalid argument');
    }
}
