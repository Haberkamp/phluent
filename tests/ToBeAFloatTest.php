<?php

namespace Phluent\Tests;

use PHPUnit\Framework\AssertionFailedError;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

use function Phluent\Expect;

class ToBeAFloatTest extends TestCase
{
    #[Test]
    public function passes_when_expecting_float_and_getting_one(): void
    {
        // ARRANGE
        $value = 1.87;

        // ACT & ASSERT
        Expect($value)->toBeAFloat();
    }

    #[Test]
    #[DataProvider('provideNonFloatValues')]
    public function fails_when_expecting_a_float_and_not_getting_one(mixed $value): void
    {
        // ASSERT
        $this->expectException(AssertionFailedError::class);

        // ACT
        Expect($value)->toBeAFloat();
    }

    #[Test]
    #[DataProvider('provideNonFloatValues')]
    public function passes_when_not_expecting_a_float_value_and_not_getting_one(mixed $value): void
    {
        // ACT & ASSERT
        Expect($value)->not()->toBeAFloat();
    }

    #[Test]
    public function fails_when_not_expecting_a_float_but_getting_one(): void
    {
        // ARRANGE
        $value = 1.87;

        // ASSERT
        $this->expectException(AssertionFailedError::class);

        // ACT
        Expect($value)->not()->toBeAFloat();
    }

    public static function provideNonFloatValues(): array
    {
        return [
            [null],
            [true],
            [false],
            [''],
            ['1.87'],
            ['1'],
            [1],
            [0],
            [[]],
            [new \stdClass()],
        ];
    }
}
