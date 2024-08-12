<?php

namespace Phluent\Tests;

use PHPUnit\Framework\AssertionFailedError;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

use function Phluent\Expect;

class ToBeEmptyTest extends TestCase
{
    #[Test]
    public function passes_when_expecting_an_empty_string_and_getting_an_empty_string(): void
    {
        // ARRANGE
        $value = '';

        // ACT & ASSERT
        Expect($value)->toBeEmpty();
    }

    #[Test]
    #[DataProvider('provideNonEmptyStrings')]
    public function fails_when_expecting_an_empty_string_but_getting_a_non_empty_string(string $value): void
    {
        // ASSERT
        $this->expectException(AssertionFailedError::class);

        // ACT
        Expect($value)->toBeEmpty();
    }

    #[Test]
    #[DataProvider('provideNonEmptyStrings')]
    public function passes_when_not_expecting_an_empty_string_and_not_getting_an_empty_string(string $value): void
    {
        // ACT & ASSERT
        Expect($value)->not()->toBeEmpty();
    }

    #[Test]
    public function fails_when_not_expecting_an_empty_string_but_getting_an_empty_string(): void
    {
        // ARRANGE
        $value = '';

        // ASSERT
        $this->expectException(AssertionFailedError::class);

        // ACT
        Expect($value)->not()->toBeEmpty();
    }

    #[Test]
    public function passes_when_expecting_array_to_be_empty_and_it_is_empty(): void
    {
        // ARRANGE
        $value = [];

        // ACT & ASSERT
        Expect($value)->toBeEmpty();
    }

    #[Test]
    public function fails_when_expecting_array_to_be_empty_and_it_is_not_empty(): void
    {
        // ARRANGE
        $value = [1, 2, 3];

        // ASSERT
        $this->expectException(AssertionFailedError::class);

        // ACT
        Expect($value)->toBeEmpty();
    }

    #[Test]
    public function passes_when_expecting_array_not_to_be_empty_and_it_is_not_empty(): void
    {
        // ARRANGE
        $value = [1, 2, 3];

        // ACT & ASSERT
        Expect($value)->not()->toBeEmpty();
    }

    #[Test]
    public function fails_when_expecting_array_not_to_be_empty_but_it_is_empty(): void
    {
        // ARRANGE
        $value = [];

        // ASSERT
        $this->expectException(AssertionFailedError::class);

        // ACT
        Expect($value)->not()->toBeEmpty();
    }

    public static function provideNonEmptyStrings(): array
    {
        return [
            [' '],
            ["Hello, world!"],
            ["\n"],
            ["\x00"],
            ["\t"],
            ["\r"],
        ];
    }
}
