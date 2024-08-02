<?php

namespace Phluent;

use PHPUnit\Framework\Assert;

class FluentAssert extends Assert {
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

    public function not(): static
    {
        $this->inverse = true;

        return $this;
    }
}
