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

    public function not(): static
    {
        $this->inverse = true;

        return $this;
    }
}
