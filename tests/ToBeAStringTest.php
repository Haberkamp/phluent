<?php

namespace Phluent\Tests;

use PHPUnit\Framework\AssertionFailedError;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

use function Phluent\Expect;

class ToBeAStringTest extends TestCase
{
    #[Test]
    public function passes_when_expecting_a_string_value_and_getting_string(): void
    {
        // ARRANGE
        $value = 'Hello, world!';

        // ACT & ASSERT
        Expect($value)->toBeAString();
    }

    #[Test]
    #[DataProvider('provideNonStringValues')]
    public function fails_when_expecting_a_string_value_but_not_getting_string(mixed $value): void
    {
        // ASSERT
        $this->expectException(AssertionFailedError::class);

        // ACT
        Expect($value)->toBeAString();
    }

    #[Test]
    #[DataProvider('provideNonStringValues')]
    public function passes_when_not_expecting_a_string_value_and_not_getting_string(mixed $value): void
    {
        // ACT & ASSERT
        Expect($value)->not()->toBeAString();
    }

    #[Test]
    public function fails_when_not_expecting_a_string_but_getting_a_string(): void
    {
        // ARRANGE
        $value = 'Hello, world!';

        // ASSERT
        $this->expectException(AssertionFailedError::class);

        // ACT
        Expect($value)->not()->toBeAString();
    }

    public static function provideNonStringValues(): array
    {
        return [
            [null],
            [true],
            [false],
            [0],
            [1],
            [0.0],
            [1.0],
            [[]],
            [new \stdClass()],
        ];
    }
}
