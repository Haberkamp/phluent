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
    #[TestWith([['foo', 'bar', 'baz'], ['qux']])]
    #[TestWith([[1, 'foo', 3], [false, true]])]
    #[TestWith([[1, 2, true], [3, 'bar']])]
    #[TestWith([[null, true, true], [2]])]
    public function fails_when_expecting_array_to_contain_any_of_the_expected_items_but_it_does_not_contain_any_of_them(array $value, array $expected): void
    {
        // ASSERT
        $this->expectException(AssertionFailedError::class);

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
    #[TestWith([['foo', 'bar', 'baz'], ['foo']])]
    #[TestWith([[1, 'foo', 3], [3]])]
    #[TestWith([[1, 2, true], [1, 2]])]
    #[TestWith([[null, true, true], [null, 2]])]
    public function fails_when_expecting_array_not_to_contain_any_of_the_expected_items_but_it_does_contain_at_least_one_of_them(array $value, array $expected): void
    {
        // ASSERT
        $this->expectException(AssertionFailedError::class);

        // ACT
        Expect($value)->not()->toContainAnyOf($expected);
    }
}
