<?php

namespace Phluent\Tests;

use PHPUnit\Framework\AssertionFailedError;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

use function Phluent\Expect;

class ToContainTest extends TestCase
{
    #[Test]
    #[DataProvider('providePrimitiveValues')]
    public function passes_when_expecting_array_to_contain_expected_item_and_it_is_there(mixed $item): void
    {
        // ARRANGE
        $value = [$item, 'bar', 'baz'];

        // ACT & ASSERT
        Expect($value)->toContain($item);
    }

    #[Test]
    #[DataProvider('providePrimitiveValues')]
    public function fails_when_expecting_array_to_contain_expected_item_but_is_is_not_inside_the_array(mixed $item): void
    {
        // ARRANGE
        $value = ['bar', 'baz'];

        // ASSERT
        $this->expectException(AssertionFailedError::class);

        // ACT
        Expect($value)->toContain($item);
    }

    #[Test]
    #[DataProvider('providePrimitiveValues')]
    public function passes_when_expecting_array_not_to_contain_expected_item_and_the_array_does_not_contain_it(mixed $item): void
    {
        // ARRANGE
        $value = ['bar', 'baz'];

        // ACT & ASSERT
        Expect($value)->not()->toContain($item);
    }

    #[Test]
    #[DataProvider('providePrimitiveValues')]
    public function fails_when_expecting_array_not_to_contain_expected_item_but_the_array_contains_the_item(mixed $item): void
    {
        // ARRANGE
        $value = [$item, 'bar', 'baz'];

        // ASSERT
        $this->expectException(AssertionFailedError::class);

        // ACT
        Expect($value)->not()->toContain($item);
    }

    #[Test]
    public function passes_when_expecting_string_to_contain_substring_and_it_does(): void
    {
        // ARRANGE
        $value = 'Hello, world!';

        // ACT & ASSERT
        Expect($value)->toContain('world');
    }

    #[Test]
    public function fails_when_expecting_string_to_contain_substring_and_it_does_not(): void
    {
        // ARRANGE
        $value = 'Hello, world!';

        // ASSERT
        $this->expectException(AssertionFailedError::class);

        // ACT
        Expect($value)->toContain('universe');
    }

    #[Test]
    public function passes_when_expecting_string_not_to_contain_substring_and_it_does_not_contain_it(): void
    {
        // ARRANGE
        $value = 'Hello, world!';

        // ACT & ASSERT
        Expect($value)->not()->toContain('universe');
    }

    #[Test]
    public function fails_when_expecting_string_not_to_contain_substring_and_it_does_actually_contain_it(): void
    {
        // ARRANGE
        $value = 'Hello, world!';

        // ASSERT
        $this->expectException(AssertionFailedError::class);

        // ACT
        Expect($value)->not()->toContain('world');
    }

    public static function providePrimitiveValues(): array
    {
        return [
            ['foo'],
            [1],
            [1.0],
            [true],
            [false],
            [null],
        ];
    }
}
