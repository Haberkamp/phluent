<?php

namespace Phluent\Tests;

use PHPUnit\Framework\AssertionFailedError;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

use function Phluent\Expect;

class CommonAssertionTest extends TestCase
{
    #[Test]
    #[DataProvider('provideEqualValues')]
    public function passes_when_actual_value_is_the_same_as_the_expected_value(mixed $value, mixed $expected): void
    {
        // ACT & ASSERT
        Expect($value)->toBe($expected);
    }

    #[Test]
    #[DataProvider('provideUnequalValues')]
    public function fails_when_actual_value_is_different_from_expected_value(mixed $value, mixed $expected): void
    {
        // ASSERT
        $this->expectException(AssertionFailedError::class);

        // ACT
        Expect($value)->toBe($expected);
    }

    #[Test]
    #[DataProvider('provideUnequalValues')]
    public function passes_when_expecting_actual_value_to_be_different_from_expected_value_and_it_is(mixed $value, mixed $expected): void
    {
        // ACT & ASSERT
        Expect($value)->not()->toBe($expected);
    }

    #[Test]
    #[DataProvider('provideEqualValues')]
    public function fails_when_expecting_actual_value_to_be_different_from_expected_value_but_it_is_not(mixed $value, mixed $expected): void
    {
        // ASSERT
        $this->expectException(AssertionFailedError::class);

        // ACT
        Expect($value)->not()->toBe($expected);
    }

    public static function provideUnequalValues(): array
    {
        return [
            [true, false],
            [false, true],
            [1, 0],
            [0, 1],
            [-1, 1],
            ['foo', 'bar'],
            ['', 'foo'],
            [null, 'foo'],
            [1.1, 1.2],
        ];
    }

    public static function provideEqualValues(): array
    {
        return [
            [true, true],
            [false, false],
            [1, 1],
            [0, 0],
            [-1, -1],
            ['foo', 'foo'],
            ['', ''],
            [null, null],
            [1.1, 1.1],
        ];
    }
}
