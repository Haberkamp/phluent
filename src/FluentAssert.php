<?php

namespace Phluent;

use PHPUnit\Framework\Assert;

class FluentAssert extends Assert {
    public function __construct(private readonly mixed $value)
    {
    }

    public function toBeTrue(): void
    {
        self::assertTrue($this->value);
    }
}
