<?php

namespace Phluent\Tests;

use PHPUnit\Framework\AssertionFailedError;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

use function Phluent\Expect;

class ToBeInstanceOfTest extends TestCase
{
    #[Test]
    public function passes_when_expecting_class_to_be_instance_of_expected_class_and_it_is(): void
    {
        // ARRANGE
        $value = new \stdClass();

        // ACT & ASSERT
        Expect($value)->toBeInstanceOf(\stdClass::class);
    }

    #[Test]
    public function fails_when_expecting_class_to_be_instance_of_expected_class_but_it_is_not(): void
    {
        // ARRANGE
        $value = new \stdClass();

        // ASSERT
        $this->expectException(AssertionFailedError::class);

        // ACT
        Expect($value)->toBeInstanceOf(\DateTime::class);
    }

    #[Test]
    public function passes_when_expecting_class_not_to_be_instance_of_expected_class_and_it_is_not(): void
    {
        // ARRANGE
        $value = new \stdClass();

        // ACT & ASSERT
        Expect($value)->not()->toBeInstanceOf(\DateTime::class);
    }

    #[Test]
    public function fails_when_expecting_class_not_to_be_instance_of_expected_class_but_it_is(): void
    {
        // ARRANGE
        $value = new \stdClass();

        // ASSERT
        $this->expectException(AssertionFailedError::class);

        // ACT
        Expect($value)->not()->toBeInstanceOf(\stdClass::class);
    }
}
