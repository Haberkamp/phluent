<?php

namespace Phluent\WithMessageSupplement;

class ErroredWithMessageSupplement implements WithMessageSupplement
{
    public function withMessage(string $message): void
    {
        throw new \RuntimeException('Cannot assert exception message when not expecting an exception to be thrown.');
    }
}
