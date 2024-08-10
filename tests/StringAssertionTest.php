<?php

namespace Phluent\Tests;

use PHPUnit\Framework\AssertionFailedError;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

use function Phluent\Expect;

class StringAssertionTest extends TestCase
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

        // ACT
        Expect($value)->not()->toStartWith('Hello');
    }

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
