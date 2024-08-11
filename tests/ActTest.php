<?php

namespace Phluent\Tests;

use PHPUnit\Framework\AssertionFailedError;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

use function Phluent\Expect;
use function Phluent\Act;

class ActTest extends TestCase
{
    #[Test]
    public function passes_when_expecting_to_throw_an_exception_and_one_gets_thrown(): void
    {
        // ARRANGE
        $callback = fn () => throw new \Exception();

        // ACT
        $result = Act($callback);

        // ASSERT
        Expect($result)->toHaveThrown(\Exception::class);
    }

    #[Test]
    public function fails_when_expecting_to_throw_an_exception_but_none_gets_thrown(): void
    {
        // ARRANGE
        $callback = fn () => null;

        // ASSERT
        $this->expectException(AssertionFailedError::class);

        // ACT
        $result = Act($callback);
        Expect($result)->toHaveThrown(\Exception::class);
    }

    #[Test]
    public function passes_when_expecting_not_to_throw_an_exception_and_none_gets_thrown(): void
    {
        // ARRANGE
        $callback = fn () => null;

        // ACT
        $result = Act(fn () => $callback);

        // ASSERT
        Expect($result)->not()->toHaveThrown();
    }

    #[Test]
    public function fails_when_expecting_not_to_throw_an_exception_and_one_gets_thrown(): void
    {
        // ARRANGE
        $callback = fn () => throw new \Exception('hi');

        // ASSERT
        $this->expectException(AssertionFailedError::class);
        $this->expectExceptionMessage('Expected no exception to be thrown, Exception was thrown.');

        // ACT
        $result = Act($callback);
        Expect($result)->not()->toHaveThrown();
    }
}
