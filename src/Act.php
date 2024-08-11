<?php

namespace Phluent;

function Act(callable $callback): Result
{
    try {
        $result = $callback();

        return Result::some($result);
    } catch (\Exception $exception) {
        return Result::error($exception);
    }
}
