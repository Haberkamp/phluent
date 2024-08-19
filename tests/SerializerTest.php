<?php

namespace Phluent\Tests;

use Phluent\Serializer;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\TestWith;
use PHPUnit\Framework\TestCase;

use function Phluent\Expect;

class SerializerTest extends TestCase
{
    #[Test]
    #[TestWith([true, 'true'])]
    #[TestWith([false, 'false'])]
    public function serializes_a_boolean(bool $value, string $expected): void
    {
        // ARRANGE
        $subject = Serializer::class;

        // ACT
        $result = $subject::serialize($value);

        // ASSERT
        Expect($result)->toBe($expected);
    }

    #[Test]
    public function serializes_null(): void
    {
        // ARRANGE
        $subject = Serializer::class;

        // ACT
        $result = $subject::serialize(null);

        // ASSERT
        Expect($result)->toBe('null');
    }

    #[Test]
    public function serializes_integers(): void
    {
        // ARRANGE
        $subject = Serializer::class;

        // ACT
        $result = $subject::serialize(1);

        // ASSERT
        Expect($result)->toBe('1');
    }

    #[Test]
    public function serializes_strings(): void
    {
        // ARRANGE
        $subject = Serializer::class;

        // ACT
        $result = $subject::serialize('Hello, world!');

        // ASSERT
        Expect($result)->toBe('\'Hello, world!\'');
    }

    #[Test]
    #[TestWith([1.1, '1.1'])]
    #[TestWith([1.0, '1.0'])]
    public function serializes_floats(float $value, string $expected): void
    {
        // ARRANGE
        $subject = Serializer::class;

        // ACT
        $result = $subject::serialize($value);

        // ASSERT
        Expect($result)->toBe($expected);
    }

    #[Test]
    public function serializes_an_array(): void
    {
        // ARRANGE
        $subject = Serializer::class;

        // ACT
        $result = $subject::serialize([1, 2, 3]);

        // ASSERT
        Expect($result)->toBe('Array (3) [1, 2, 3]');
    }

    #[Test]
    public function serializes_nested_array(): void
    {
        // ARRANGE
        $subject = Serializer::class;

        // ACT
        $result = $subject::serialize([1, [2, 3]]);

        // ASSERT
        Expect($result)->toBe('Array (2) [1, Array (2) [2, 3]]');
    }
}
