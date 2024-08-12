<?php

namespace Phluent\Tests;

use PHPUnit\Framework\AssertionFailedError;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\TestWith;
use PHPUnit\Framework\TestCase;

use function Phluent\Expect;

class ToContainTest extends TestCase
{
    #[Test]
    #[TestWith(['foo'])]
    #[TestWith([1])]
    #[TestWith([1.0])]
    #[TestWith([true])]
    #[TestWith([false])]
    #[TestWith([null])]
    public function passes_when_expecting_array_to_contain_expected_item_and_it_is_there(mixed $item): void
    {
        // ARRANGE
        $value = [$item, 'bar', 'baz'];

        // ACT & ASSERT
        Expect($value)->toContain($item);
    }

    #[Test]
    #[TestWith(['foo', "Expected array to contain 'foo', but it does not: Array &0 [\n    0 => 'bar',\n    1 => 'baz',\n]"])]
    #[TestWith([1, "Expected array to contain 1, but it does not: Array &0 [\n    0 => 'bar',\n    1 => 'baz',\n]"])]
    #[TestWith([1.0, "Expected array to contain 1.0, but it does not: Array &0 [\n    0 => 'bar',\n    1 => 'baz',\n]"])]
    #[TestWith([true, "Expected array to contain true, but it does not: Array &0 [\n    0 => 'bar',\n    1 => 'baz',\n]"])]
    #[TestWith([false, "Expected array to contain false, but it does not: Array &0 [\n    0 => 'bar',\n    1 => 'baz',\n]"])]
    #[TestWith([null, "Expected array to contain null, but it does not: Array &0 [\n    0 => 'bar',\n    1 => 'baz',\n]"])]
    public function fails_when_expecting_array_to_contain_expected_item_but_is_is_not_inside_the_array(mixed $item, string $message): void
    {
        // ARRANGE
        $value = ['bar', 'baz'];

        // ASSERT
        $this->expectException(AssertionFailedError::class);
        $this->expectExceptionMessage($message);

        // ACT
        Expect($value)->toContain($item);
    }

    #[Test]
    #[TestWith(['foo'])]
    #[TestWith([1])]
    #[TestWith([1.0])]
    #[TestWith([true])]
    #[TestWith([false])]
    #[TestWith([null])]
    public function passes_when_expecting_array_not_to_contain_expected_item_and_the_array_does_not_contain_it(mixed $item): void
    {
        // ARRANGE
        $value = ['bar', 'baz'];

        // ACT & ASSERT
        Expect($value)->not()->toContain($item);
    }

    #[Test]
    #[TestWith(['foo', "Expected array not to contain 'foo', but it does: Array &0 [\n    0 => 'foo',\n    1 => 'bar',\n    2 => 'baz',\n]"])]
    #[TestWith([1, "Expected array not to contain 1, but it does: Array &0 [\n    0 => 1,\n    1 => 'bar',\n    2 => 'baz',\n]"])]
    #[TestWith([1.0, "Expected array not to contain 1.0, but it does: Array &0 [\n    0 => 1.0,\n    1 => 'bar',\n    2 => 'baz',\n]"])]
    #[TestWith([true, "Expected array not to contain true, but it does: Array &0 [\n    0 => true,\n    1 => 'bar',\n    2 => 'baz',\n]"])]
    #[TestWith([false, "Expected array not to contain false, but it does: Array &0 [\n    0 => false,\n    1 => 'bar',\n    2 => 'baz',\n]"])]
    #[TestWith([null, "Expected array not to contain null, but it does: Array &0 [\n    0 => null,\n    1 => 'bar',\n    2 => 'baz',\n]"])]
    public function fails_when_expecting_array_not_to_contain_expected_item_but_the_array_contains_the_item(mixed $item, string $message): void
    {
        // ARRANGE
        $value = [$item, 'bar', 'baz'];

        // ASSERT
        $this->expectException(AssertionFailedError::class);
        $this->expectExceptionMessage($message);

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
        $this->expectExceptionMessage("Expected string 'Hello, world!' to contain 'universe', but it does not.");

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
        $this->expectExceptionMessage("Expected string 'Hello, world!' not to contain 'world', but it does.");

        // ACT
        Expect($value)->not()->toContain('world');
    }
}
