<?php

namespace Phluent\Tests;

use PHPUnit\Framework\AssertionFailedError;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\TestWith;
use PHPUnit\Framework\TestCase;

use function Phluent\Expect;

class ToContainAnyOfTest extends TestCase
{
    #[Test]
    #[TestWith([['foo', 'bar', 'baz'], ['foo']])]
    #[TestWith([[1, 'foo', 3], [3]])]
    #[TestWith([[1, 2, true], [1, 2]])]
    #[TestWith([[null, true, true], [null, 2]])]
    public function passes_when_expecting_array_to_contain_any_of_the_expected_value_and_it_does_contain_at_least_one_of_them(array $value, array $expected): void
    {
        // ACT & ASSERT
        Expect($value)->toContainAnyOf($expected);
    }

    #[Test]
    #[TestWith([['foo', 'bar', 'baz'], ['qux'], "Expected array to contain any of the expected items Array &0 [\n    0 => 'qux',\n], but it does not: Array &0 [\n    0 => 'foo',\n    1 => 'bar',\n    2 => 'baz',\n]"])]
    #[TestWith([[1, 'foo', 3], [false, true], "Expected array to contain any of the expected items Array &0 [\n    0 => false,\n    1 => true,\n], but it does not: Array &0 [\n    0 => 1,\n    1 => 'foo',\n    2 => 3,\n]"])]
    #[TestWith([[1, 2, true], [3, 'bar'], "Expected array to contain any of the expected items Array &0 [\n    0 => 3,\n    1 => 'bar',\n], but it does not: Array &0 [\n    0 => 1,\n    1 => 2,\n    2 => true,\n]"])]
    #[TestWith([[null, true, true], [2], "Expected array to contain any of the expected items Array &0 [\n    0 => 2,\n], but it does not: Array &0 [\n    0 => null,\n    1 => true,\n    2 => true,\n]"])]
    public function fails_when_expecting_array_to_contain_any_of_the_expected_items_but_it_does_not_contain_any_of_them(array $value, array $expected, string $message): void
    {
        // ASSERT
        $this->expectException(AssertionFailedError::class);
        $this->expectExceptionMessage($message);

        // ACT
        Expect($value)->toContainAnyOf($expected);
    }

    #[Test]
    #[TestWith([['foo', 'bar', 'baz'], ['qux']])]
    #[TestWith([[1, 'foo', 3], [false]])]
    #[TestWith([[1, 2, true], [3, 'bar']])]
    #[TestWith([[null, true, true], [2, false]])]
    public function passes_when_expecting_array_not_to_contain_any_of_the_expected_values_and_it_does_not_contain_any_of_them(array $value, array $expected): void
    {
        // ACT & ASSERT
        Expect($value)->not()->toContainAnyOf($expected);
    }

    #[Test]
    #[TestWith([['foo', 'bar', 'baz'], ['foo'], "Expected array not to contain any of the expected items Array &0 [\n    0 => 'foo',\n], but it does: Array &0 [\n    0 => 'foo',\n    1 => 'bar',\n    2 => 'baz',\n]"])]
    #[TestWith([[1, 'foo', 3], [3], "Expected array not to contain any of the expected items Array &0 [\n    0 => 3,\n], but it does: Array &0 [\n    0 => 1,\n    1 => 'foo',\n    2 => 3,\n]"])]
    #[TestWith([[1, 2, true], [1, 2], "Expected array not to contain any of the expected items Array &0 [\n    0 => 1,\n    1 => 2,\n], but it does: Array &0 [\n    0 => 1,\n    1 => 2,\n    2 => true,\n]"])]
    #[TestWith([[null, true, true], [null, 2], "Expected array not to contain any of the expected items Array &0 [\n    0 => null,\n    1 => 2,\n], but it does: Array &0 [\n    0 => null,\n    1 => true,\n    2 => true,\n]"])]
    public function fails_when_expecting_array_not_to_contain_any_of_the_expected_items_but_it_does_contain_at_least_one_of_them(array $value, array $expected, string $message): void
    {
        // ASSERT
        $this->expectException(AssertionFailedError::class);
        $this->expectExceptionMessage($message);

        // ACT
        Expect($value)->not()->toContainAnyOf($expected);
    }
}
