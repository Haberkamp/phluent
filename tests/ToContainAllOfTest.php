<?php

namespace Phluent\Tests;

use PHPUnit\Framework\AssertionFailedError;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\TestWith;
use PHPUnit\Framework\TestCase;

use function Phluent\Expect;

class ToContainAllOfTest extends TestCase
{
    #[Test]
    #[TestWith([[1, 2, 3], [1, 2]])]
    #[TestWith([[1, false, null], [false]])]
    #[TestWith([[1, 2, 'foo'], ['foo', 1, 2]])]
    public function passes_when_expecting_array_to_contain_all_of_the_expected_values_and_it_does(array $value, array $expected): void
    {
        // ACT & ASSERT
        Expect($value)->toContainAllOf($expected);
    }

    #[Test]
    #[TestWith([[1, 2, 3], [1, 4]])]
    #[TestWith([[1, false, null], [null, true]])]
    #[TestWith([[1, 2, 'foo'], ['foo', 1, 3]])]
    public function fails_when_expecting_array_to_contain_all_of_the_expected_values_but_it_only_contains_one_of_them(array $value, array $expected): void
    {
        // ASSERT
        $this->expectException(AssertionFailedError::class);

        // ACT
        Expect($value)->toContainAllOf($expected);
    }

    #[Test]
    #[TestWith([[1, 2, 3], ['foo', false, null]])]
    #[TestWith([[1, false, null], ['bar', 2, 3]])]
    #[TestWith([[1, 2, 'foo'], ['bar', false, null]])]
    public function fails_when_expecting_array_to_contain_all_of_the_expected_values_but_it_does_not_contain_any_of_the_expected_values(array $value, array $mixed): void
    {
        // ASSERT
        $this->expectException(AssertionFailedError::class);

        // ACT
        Expect($value)->toContainAllOf($mixed);
    }

    #[Test]
    #[TestWith([[1, 2, 3], [1, 4]])]
    #[TestWith([[1, false, null], [true, false]])]
    public function passes_when_expecting_array_not_to_contain_all_of_the_expected_items_and_does_not_contain_all_of_them(array $value, array $expected): void
    {
        // ACT & ASSERT
        Expect($value)->not()->toContainAllOf($expected);
    }

    #[Test]
    #[TestWith([[1, 2, 3], [1, 2]])]
    #[TestWith([[1, false, null], [false]])]
    #[TestWith([[1, 2, 'foo'], ['foo', 1, 2]])]
    public function fails_when_expecting_array_not_to_contain_all_of_the_expected_items_but_it_does_contain_all_of_them(array $value, array $expected): void
    {
        // ASSERT
        $this->expectException(AssertionFailedError::class);

        // ACT
        Expect($value)->not()->toContainAllOf($expected);
    }
}
