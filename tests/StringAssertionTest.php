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
    public function passes_when_expecting_string_to_have_one_character_and_it_actually_has_only_one_character(): void
    {
        // ARRANGE
        $value = 'a';

        // ACT & ASSERT
        Expect($value)->toHaveALengthOf(1);
    }

    #[Test]
    public function fails_when_expecting_string_to_have_one_character_but_it_has_two_characters(): void
    {
        // ARRANGE
        $value = 'ab';

        // ASSERT
        $this->expectException(AssertionFailedError::class);

        // ACT
        Expect($value)->toHaveALengthOf(1);
    }

    #[Test]
    public function passes_when_expecting_string_not_to_have_exactly_one_character_and_string_has_two_characters(): void
    {
        // ARRANGE
        $value = 'ab';

        // ACT & ASSERT
        Expect($value)->not()->toHaveALengthOf(1);
    }

    #[Test]
    public function fails_when_expecting_string_not_to_have_exactly_one_character_but_it_has_one_character(): void
    {
        // ARRANGE
        $value = 'a';

        // ASSERT
        $this->expectException(AssertionFailedError::class);

        // ACT
        Expect($value)->not()->toHaveALengthOf(1);
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
