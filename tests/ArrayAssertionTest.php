<?php

namespace Phluent\Tests;

use PHPUnit\Framework\AssertionFailedError;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

use function Phluent\Expect;

class ArrayAssertionTest extends TestCase
{
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

        // ACT
        Expect($value)->not()->toHaveALengthOf(1);
    }
}
