<?php

namespace Phluent;

class Result
{
    private function __construct(
        private mixed       $value,
        private ?\Throwable $exception = null
    ) {
    }

    public function match(callable $some, callable $error): mixed
    {
        if ($this->exception) {
            return $error($this->exception);
        }

        return $some($this->value);
    }

    public static function some(mixed $value): Result
    {
        return new Result($value);
    }

    public static function error(\Throwable $exception): Result
    {
        return new Result(null, $exception);
    }

    public static function isResult(mixed $value): bool
    {
        return $value instanceof Result;
    }
}
