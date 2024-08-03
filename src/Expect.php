<?php

namespace Phluent;

function Expect(mixed $value): FluentAssert
{
    return new FluentAssert($value);
}
