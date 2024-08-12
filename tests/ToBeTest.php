<?php

namespace Phluent\Tests;

use PHPUnit\Framework\AssertionFailedError;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\TestWith;
use PHPUnit\Framework\TestCase;

use function Phluent\Expect;

class ToBeTest extends TestCase
{
    #[Test]
    #[TestWith(['foo', 'foo'])]
    #[TestWith(['', ''])]
    #[TestWith([1, 1])]
    #[TestWith([0, 0])]
    #[TestWith([-1, -1])]
    #[TestWith([true, true])]
    #[TestWith([false, false])]
    #[TestWith([null, null])]
    #[TestWith([1.1, 1.1])]
    public function passes_when_actual_value_is_the_same_as_the_expected_value(mixed $value, mixed $expected): void
    {
        // ACT & ASSERT
        Expect($value)->toBe($expected);
    }

    #[Test]
    #[TestWith(['foo', 'bar', 'Expected \'foo\' to be the same as \'bar\', but it is not.'])]
    #[TestWith(['', 'foo', 'Expected \'\' to be the same as \'foo\', but it is not.'])]
    #[TestWith([1, 0, 'Expected 1 to be the same as 0, but it is not.'])]
    #[TestWith([0, 1, 'Expected 0 to be the same as 1, but it is not.'])]
    #[TestWith([-1, 1, 'Expected -1 to be the same as 1, but it is not.'])]
    #[TestWith([true, false, 'Expected true to be the same as false, but it is not.'])]
    #[TestWith([false, true, 'Expected false to be the same as true, but it is not.'])]
    #[TestWith([null, 'foo', 'Expected null to be the same as \'foo\', but it is not.'])]
    #[TestWith([1.1, 1.2, 'Expected 1.1 to be the same as 1.2, but it is not.'])]
    public function fails_when_actual_value_is_different_from_expected_value(mixed $value, mixed $expected, string $message): void
    {
        // ASSERT
        $this->expectException(AssertionFailedError::class);
        $this->expectExceptionMessage($message);

        // ACT
        Expect($value)->toBe($expected);
    }

    #[Test]
    #[TestWith(['foo', 'bar'])]
    #[TestWith(['', 'foo'])]
    #[TestWith([1, 0])]
    #[TestWith([0, 1])]
    #[TestWith([-1, 1])]
    #[TestWith([true, false])]
    #[TestWith([false, true])]
    #[TestWith([null, 'foo'])]
    #[TestWith([1.1, 1.2])]
    public function passes_when_expecting_actual_value_to_be_different_from_expected_value_and_it_is(mixed $value, mixed $expected): void
    {
        // ACT & ASSERT
        Expect($value)->not()->toBe($expected);
    }

    #[Test]
    #[TestWith(['foo', 'foo', 'Expected \'foo\' not to be the same as \'foo\', but it is.'])]
    #[TestWith(['', '', 'Expected \'\' not to be the same as \'\', but it is.'])]
    #[TestWith([1, 1, 'Expected 1 not to be the same as 1, but it is.'])]
    #[TestWith([0, 0, 'Expected 0 not to be the same as 0, but it is.'])]
    #[TestWith([-1, -1, 'Expected -1 not to be the same as -1, but it is.'])]
    #[TestWith([true, true, 'Expected true not to be the same as true, but it is.'])]
    #[TestWith([false, false, 'Expected false not to be the same as false, but it is.'])]
    #[TestWith([null, null, 'Expected null not to be the same as null, but it is.'])]
    #[TestWith([1.1, 1.1, 'Expected 1.1 not to be the same as 1.1, but it is.'])]
    public function fails_when_expecting_actual_value_to_be_different_from_expected_value_but_it_is_not(mixed $value, mixed $expected, string $message): void
    {
        // ASSERT
        $this->expectException(AssertionFailedError::class);
        $this->expectExceptionMessage($message);

        // ACT
        Expect($value)->not()->toBe($expected);
    }
}
