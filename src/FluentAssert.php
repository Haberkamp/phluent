<?php

namespace Phluent;

use PHPUnit\Framework\Assert;

class FluentAssert extends Assert
{
    private bool $inverse = false;

    public function __construct(private readonly mixed $value)
    {
    }

    public function toBeTrue(): void
    {
        if ($this->inverse) {
            self::assertFalse($this->value);
            return;
        }

        self::assertTrue($this->value);
    }

    public function toBeFalse(): void
    {
        if ($this->inverse) {
            self::assertTrue($this->value);
            return;
        }

        self::assertFalse($this->value);
    }

    public function toBeABoolean(): void
    {
        if ($this->inverse) {
            self::assertIsNotBool($this->value);
            return;
        }

        self::assertIsBool($this->value);
    }

    public function toBeNull(): void
    {
        if ($this->inverse) {
            self::assertNotNull($this->value);
            return;
        }

        self::assertNull($this->value);
    }

    public function toHaveALengthOf(int $length): void
    {
        if ($this->inverse) {
            if (is_array($this->value)) {
                self::assertNotCount($length, $this->value);
                return;
            }

            self::assertNotSame($length, strlen($this->value));
            return;
        }

        if (is_array($this->value)) {
            self::assertCount($length, $this->value);
            return;
        }

        self::assertSame($length, strlen($this->value));
    }

    public function toBeEmpty(): void
    {
        if ($this->inverse) {
            self::assertNotEmpty($this->value);
            return;
        }

        self::assertEmpty($this->value);
    }

    public function toBeAString(): void
    {
        if ($this->inverse) {
            self::assertIsNotString($this->value);
            return;
        }

        self::assertIsString($this->value);
    }

    public function toBe(mixed $string): void
    {
        if ($this->inverse) {
            self::assertNotSame($string, $this->value);
            return;
        }

        self::assertSame($string, $this->value);
    }

    public function toStartWith(string $prefix): void
    {
        if ($this->inverse) {
            self::assertStringStartsNotWith($prefix, $this->value);
            return;
        }

        self::assertStringStartsWith($prefix, $this->value);
    }

    public function toEndWith(string $suffix): void
    {
        if ($this->inverse) {
            self::assertStringEndsNotWith($suffix, $this->value);
            return;
        }

        self::assertStringEndsWith($suffix, $this->value);
    }

    public function toContain(string $substring): void
    {
        if ($this->inverse) {
            self::assertStringNotContainsString($substring, $this->value);
            return;
        }

        self::assertStringContainsString($substring, $this->value);
    }

    public function toBeAFloat(): void
    {
        if ($this->inverse) {
            self::assertIsNotFloat($this->value);
            return;
        }

        self::assertIsFloat($this->value);
    }

    public function toBeAnInteger(): void
    {
        if ($this->inverse) {
            self::assertIsNotInt($this->value);
            return;
        }

        self::assertIsInt($this->value);
    }

    public function toBeNegative(): void
    {
        if ($this->inverse) {
            self::assertGreaterThan(-1, $this->value);
            return;
        }

        self::assertLessThan(0, $this->value);
    }

    public function toBePositive(): void
    {
        if ($this->inverse) {
            self::assertLessThan(1, $this->value);
            return;
        }

        self::assertGreaterThan(0, $this->value);
    }

    public function toBeGreaterThan(int|float $baseline): void
    {
        if ($this->inverse) {
            self::assertLessThan($baseline, $this->value);
            return;
        }

        self::assertGreaterThan($baseline, $this->value);
    }

    public function toBeInBetween(int|float $start, int|float $end): void
    {
        if ($this->inverse) {
            self::assertThat(
                $this->value,
                self::logicalOr(
                    self::lessThan($start),
                    self::greaterThan($end),
                ),
            );

            return;
        }

        self::assertThat(
            $this->value,
            self::logicalAnd(
                self::greaterThanOrEqual($start),
                self::lessThanOrEqual($end),
            ),
        );
    }

    public function toBeLessThan(int|float $baseline): void
    {
        if ($this->inverse) {
            self::assertGreaterThan($baseline, $this->value);
            return;
        }

        self::assertLessThan($baseline, $this->value);
    }

    public function toBeLessThanOrEqual(int|float $baseline): void
    {
        if ($this->inverse) {
            self::assertGreaterThan($baseline, $this->value);
            return;
        }

        self::assertLessThanOrEqual($baseline, $this->value);
    }

    public function toBeGreaterThanOrEqual(int|float $baseline): void
    {
        if ($this->inverse) {
            self::assertLessThan($baseline, $this->value);
            return;
        }

        self::assertGreaterThanOrEqual($baseline, $this->value);
    }

    public function not(): static
    {
        $this->inverse = true;

        return $this;
    }
}
