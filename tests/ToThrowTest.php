<?php

namespace Phluent\Tests;

use PHPUnit\Framework\AssertionFailedError;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

use function Phluent\Expect;

class ToThrowTest extends TestCase
{
    #[Test]
    public function passes_when_expecting_function_to_throw_and_exception_and_it_does(): void
    {
        // ARRANGE
        $callback = fn () => throw new \Exception();

        // ACT & ASSERT
        Expect($callback)->toThrow();
    }

    #[Test]
    public function fails_when_expecting_function_to_throw_and_it_does_not_throw_any_exception(): void
    {
        // ARRANGE
        $callback = fn () => null;

        // ASSERT
        $this->expectException(AssertionFailedError::class);
        $this->expectExceptionMessage('Expected an exception to be thrown, but no exception was thrown.');

        // ACT
        Expect($callback)->toThrow();
    }

    #[Test]
    public function passes_when_expecting_function_not_to_throw_an_exception_and_it_does_not(): void
    {
        // ARRANGE
        $callback = fn () => null;

        // ACT & ASSERT
        Expect($callback)->not()->toThrow();
    }

    #[Test]
    public function fails_when_expecting_function_not_to_throw_an_exception_but_it_does_throw_one(): void
    {
        // ARRANGE
        $callback = fn () => throw new \Exception();

        // ASSERT
        $this->expectException(AssertionFailedError::class);
        $this->expectExceptionMessage('Expected no exception to be thrown, Exception was thrown.');

        // ACT
        Expect($callback)->not()->toThrow();
    }

    #[Test]
    public function passes_when_expecting_specific_exception_to_be_thrown_and_the_expected_exception_got_thrown(): void
    {
        // ARRANGE
        $callback = fn () => throw new \InvalidArgumentException();

        // ACT & ASSERT
        Expect($callback)->toThrow(\InvalidArgumentException::class);
    }

    #[Test]
    public function fails_when_expecting_specific_exception_to_be_thrown_but_a_different_exception_got_thrown(): void
    {
        // ARRANGE
        $callback = fn () => throw new \RuntimeException();

        // ASSERT
        $this->expectException(AssertionFailedError::class);
        $this->expectExceptionMessage('Expected InvalidArgumentException to be thrown, but RuntimeException was thrown.');

        // ACT
        Expect($callback)->toThrow(\InvalidArgumentException::class);
    }

    #[Test]
    public function passes_when_expecting_specific_exception_not_to_be_thrown_and_a_different_exception_gets_thrown(): void
    {
        // ARRANGE
        $callback = fn () => throw new \RuntimeException();

        // ACT & ASSERT
        Expect($callback)->not()->toThrow(\InvalidArgumentException::class);
    }

    #[Test]
    public function fails_when_expecting_specific_exception_not_to_be_thrown_but_the_expected_exception_got_thrown(): void
    {
        // ARRANGE
        $callback = fn () => throw new \InvalidArgumentException();

        // ASSERT
        $this->expectException(AssertionFailedError::class);
        $this->expectExceptionMessage('Expected no exception to be thrown, InvalidArgumentException was thrown.');

        // ACT
        Expect($callback)->not()->toThrow(\InvalidArgumentException::class);
    }
}
