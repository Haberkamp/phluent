<?php

namespace Phluent\WithMessageSupplement;

readonly class ValidWithMessageSupplement implements WithMessageSupplement
{
    public function __construct(private \Exception $exception, private mixed $succeed, private mixed $fail)
    {
    }

    public function withMessage(string $message): void
    {
        $correctMessage = $this->exception->getMessage() === $message;

        if (!$correctMessage) {
            $this->fail->__invoke('Expected exception message to be "' . $message . '", but got "' . $this->exception->getMessage() . '".');
        }

        $this->succeed->__invoke();
    }
}
