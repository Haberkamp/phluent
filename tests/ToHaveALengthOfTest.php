<?php

namespace Phluent\Tests;

use PHPUnit\Framework\AssertionFailedError;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

use function Phluent\Expect;

class ToHaveALengthOfTest extends TestCase
{
    #[Test]
    public function passes_when_expecting_array_to_have_a_length_of_one_and_the_array_has_one_item(): void
    {
        // ARRANGE
        $value = ['Hello'];

        // ACT & ASSERT
        Expect($value)->toHaveALengthOf(1);
    }

    #[Test]
    public function fails_when_expecting_array_to_have_one_item_but_it_has_two_items(): void
    {
        // ARRANGE
        $value = ['Hello', 'World'];

        // ASSERT
        $this->expectException(AssertionFailedError::class);
        $this->expectExceptionMessage("Expected array to contain 1 items(s), but found 2 item(s): Array &0 [\n    0 => 'Hello',\n    1 => 'World',\n]");

        // ACT
        Expect($value)->toHaveALengthOf(1);
    }

    #[Test]
    public function passes_when_expecting_array_not_to_have_exactly_one_item_and_it_is_empty(): void
    {
        // ARRANGE
        $value = [];

        // ACT & ASSERT
        Expect($value)->not()->toHaveALengthOf(1);
    }

    #[Test]
    public function fails_when_expecting_array_not_to_have_exactly_one_item_but_is_has_one_item(): void
    {
        // ARRANGE
        $value = ['Hello'];

        // ASSERT
        $this->expectException(AssertionFailedError::class);
        $this->expectExceptionMessage("Expected array not to contain 1 items(s), but found 1 item(s): Array &0 [\n    0 => 'Hello',\n]");

        // ACT
        Expect($value)->not()->toHaveALengthOf(1);
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
        $this->expectExceptionMessage("Expected string to contain 1 character(s), but found 2 character(s): 'ab'");

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
        $this->expectExceptionMessage("Expected string not to contain 1 character(s), but found 1 character(s): 'a'");

        // ACT
        Expect($value)->not()->toHaveALengthOf(1);
    }
}
