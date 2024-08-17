<?php

namespace Phluent;

use Phluent\WithMessageSupplement\ErroredWithMessageSupplement;
use Phluent\WithMessageSupplement\ValidWithMessageSupplement;
use Phluent\WithMessageSupplement\WithMessageSupplement;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\AssertionFailedError;
use PHPUnit\Util\Exporter;
use Throwable;

class FluentAssert extends Assert
{
    private bool $inverse = false;

    private readonly mixed $value;

    private ?Throwable $exception = null;

    public function __construct(mixed $value)
    {
        if (!Result::isResult($value)) {
            $this->value = $value;

            return;
        }

        $value->match(
            some: fn ($value) => $this->value = $value,
            error: fn ($exception) => $this->exception = $exception
        );
    }

    public function toBeTrue(): void
    {
        if ($this->inverse) {
            if ($this->value) {
                self::fail('Expected boolean to be false, got true.');
            }

            self::succeed();
            return;
        }

        if ($this->value === false) {
            self::fail('Expected boolean to be true, got false');
        }

        self::succeed();
    }

    public function toBeFalse(): void
    {
        if ($this->inverse) {
            if ($this->value === false) {
                self::fail('Expected boolean to be true, got false.');
            }

            self::succeed();
            return;
        }

        if ($this->value === true) {
            self::fail('Expected boolean to be false, got true.');
        }

        self::succeed();
    }

    public function toBeABoolean(): void
    {
        if ($this->inverse) {
            if (is_bool($this->value)) {
                self::fail('Expected value not to be a boolean, got ' . Exporter::export($this->value) . '.');
            }

            self::succeed();
            return;
        }

        if (!is_bool($this->value)) {
            self::fail('Expected value to be a boolean, got ' . Exporter::export($this->value) . '.');
        }

        self::succeed();
    }

    public function toBeNull(): void
    {
        if ($this->inverse) {
            if (is_null($this->value)) {
                self::fail('Expected value not to be null, got null.');
            }

            self::succeed();
            return;
        }

        if (!is_null($this->value)) {
            self::fail('Expected value to be null, got ' . Exporter::export($this->value) . '.');
        }

        self::succeed();
    }

    public function toHaveALengthOf(int $length): void
    {
        if ($this->inverse) {
            if (is_array($this->value)) {
                if (count($this->value) === $length) {
                    self::fail('Expected array not to contain ' . $length . ' items(s), but found ' . count($this->value) . ' item(s): ' . Exporter::export($this->value));
                }

                self::succeed();
                return;
            }

            if (strlen($this->value) === $length) {
                self::fail('Expected string not to contain ' . $length . ' character(s), but found ' . strlen($this->value) . ' character(s): ' . Exporter::export($this->value));
            }

            self::succeed();
            return;
        }

        if (is_array($this->value)) {
            if (count($this->value) !== $length) {
                self::fail('Expected array to contain ' . $length . ' items(s), but found ' . count($this->value) . ' item(s): ' . Exporter::export($this->value));
            }

            self::succeed();
            return;
        }

        if (strlen($this->value) !== $length) {
            self::fail('Expected string to contain ' . $length . ' character(s), but found ' . strlen($this->value) . ' character(s): ' . Exporter::export($this->value));
        }

        self::succeed();
    }

    public function toBeEmpty(): void
    {
        if ($this->inverse) {
            if (is_string($this->value)) {
                if (strlen($this->value) === 0) {
                    self::fail('Expected string not to be empty, but it is.');
                }

                self::succeed();
                return;
            }

            if (count($this->value) === 0) {
                self::fail('Expected array not to be empty, but it is.');
            }

            self::succeed();
            return;
        }

        if (is_string($this->value)) {
            if (strlen($this->value) !== 0) {
                self::fail('Expected string to be empty, got ' . Exporter::export($this->value) . '.');
            }

            self::succeed();
            return;
        }

        if (count($this->value) !== 0) {
            self::fail('Expected array to be empty, counted ' . count($this->value) . ' item(s): ' . Exporter::export($this->value));
        }

        self::succeed();
    }

    public function toBeAString(): void
    {
        $isAString = is_string($this->value);

        if ($this->inverse && $isAString) {
            self::fail('Expected value not to be a string, got ' . Exporter::export($this->value) . '.');
        }

        if (!$this->inverse && !$isAString) {
            self::fail('Expected value to be a string, got ' . Exporter::export($this->value) . '.');
        }

        self::succeed();
    }

    public function toBe(mixed $string): void
    {
        $isSame = $this->value === $string;

        if ($this->inverse && $isSame) {
            self::fail('Expected ' . Exporter::export($this->value) . ' not to be the same as ' . Exporter::export($string) . ', but it is.');
        }

        if (!$this->inverse && !$isSame) {
            self::fail('Expected ' . Exporter::export($this->value) . ' to be the same as ' . Exporter::export($string) . ', but it is not.');
        }

        self::succeed();
    }

    public function toStartWith(string $prefix): void
    {
        $startsWithPrefix = str_starts_with($this->value, $prefix);

        if ($this->inverse && $startsWithPrefix) {
            self::fail('Expected "' . $this->value . '" not to start with "' . $prefix . '", but it does.');
        }

        if (!$this->inverse && !$startsWithPrefix) {
            self::fail('Expected "' . $this->value . '" to start with "' . $prefix . '", but it does not.');
        }

        self::succeed();
    }

    public function toEndWith(string $suffix): void
    {
        $containsSuffix = str_ends_with($this->value, $suffix);

        if ($this->inverse && $containsSuffix) {
            self::fail('Expected string "' . $this->value . '" not to end with "' . $suffix . '", but it does.');
        }

        if (!$this->inverse && !$containsSuffix) {
            self::fail('Expected string "' . $this->value . '" to end with "' . $suffix . '", but it does not.');
        }

        self::succeed();
    }

    public function toContain(mixed $item): void
    {
        if ($this->inverse) {
            if (is_array($this->value)) {
                if (in_array($item, $this->value, true)) {
                    self::fail('Expected array not to contain ' . Exporter::export($item) . ', but it does: ' . Exporter::export($this->value));
                }

                self::succeed();
                return;
            }

            if (str_contains($this->value, $item)) {
                self::fail('Expected string ' . Exporter::export($this->value) . ' not to contain ' . Exporter::export($item) . ', but it does.');
            }

            self::succeed();
            return;
        }

        if (is_array($this->value)) {
            if (!in_array($item, $this->value, true)) {
                self::fail('Expected array to contain ' . Exporter::export($item) . ', but it does not: ' . Exporter::export($this->value));
            }

            self::succeed();
            return;
        }

        if (!str_contains($this->value, $item)) {
            self::fail('Expected string ' . Exporter::export($this->value) . ' to contain ' . Exporter::export($item) . ', but it does not.');
        }

        self::succeed();
    }

    public function toBeAFloat(): void
    {
        $isAFloat = is_float($this->value);

        if ($this->inverse && $isAFloat) {
            self::fail('Expected ' . Exporter::export($this->value) . ' not to be a float, but it is.');
        }

        if (!$this->inverse && !$isAFloat) {
            self::fail('Expected ' . Exporter::export($this->value) . ' to be a float, but it is not.');
        }

        self::succeed();
    }

    public function toBeAnInteger(): void
    {
        $isAnInteger = is_int($this->value);
        if ($this->inverse && $isAnInteger) {
            self::fail('Expected value not to be an integer, got ' . Exporter::export($this->value) . '.');
        }

        if (!$this->inverse && !is_int($this->value)) {
            self::fail('Expected value to be an integer, got ' . Exporter::export($this->value) . '.');
        }

        self::succeed();
    }

    public function toBeNegative(): void
    {
        $isNegative = $this->value < 0;
        if ($this->inverse && $isNegative) {
            self::fail('Expected value not to be negative, got ' . $this->value . '.');
        }

        if (!$this->inverse && !$isNegative) {
            self::fail('Expected value to be negative, got ' . $this->value . '.');
        }

        self::succeed();
    }

    public function toBePositive(): void
    {
        $isPositive = $this->value > 0;

        if ($this->inverse && $isPositive) {
            self::fail('Expected value not to be positive, got ' . $this->value . '.');
        }

        if (!$this->inverse && !$isPositive) {
            self::fail('Expected value to be positive, got ' . $this->value . '.');
        }

        self::succeed();
    }

    public function toBeGreaterThan(int|float $baseline): void
    {
        $isGreaterThanBaseline = $this->value > $baseline;

        if ($this->inverse && $isGreaterThanBaseline) {
            self::fail('Expected ' . $this->value . ' not to be greater than ' . $baseline . ', but it is.');
        }

        if (!$this->inverse && !$isGreaterThanBaseline) {
            self::fail('Expected ' . $this->value . ' to be greater than ' . $baseline . ', but it\'s not.');
        }

        self::succeed();
    }

    public function toBeInBetween(int|float $start, int|float $end): void
    {
        $isInBetweenRange = $this->value >= $start && $this->value <= $end;

        if ($this->inverse && $isInBetweenRange) {
            self::fail('Expected ' . $this->value . ' not to be in between ' . $start . ' and ' . $end . ', but it is.');
        }

        if (!$this->inverse && !$isInBetweenRange) {
            self::fail('Expected ' . $this->value . ' to be in between ' . $start . ' and ' . $end . ', but it is not.');
        }

        self::succeed();
    }

    public function toBeLessThan(int|float $baseline): void
    {
        $isLessThanBaseline = $this->value < $baseline;

        if ($this->inverse && $isLessThanBaseline) {
            self::fail('Expected ' . $this->value . ' not to be less than ' . $baseline . ', but it is.');
        }

        if (!$this->inverse && !$isLessThanBaseline) {
            self::fail('Expected ' . $this->value . ' to be less than ' . $baseline . ', but it\'s not.');
        }

        self::succeed();
    }

    public function toBeLessThanOrEqual(int|float $baseline): void
    {
        $isLessThanOrEqualToBaseline = $this->value <= $baseline;

        if ($this->inverse && $isLessThanOrEqualToBaseline) {
            self::fail('Expected ' . $this->value . ' not to be less than or equal to ' . $baseline . ', but it is.');
        }

        if (!$this->inverse && !$isLessThanOrEqualToBaseline) {
            self::fail('Expected ' . $this->value . ' to be less than or equal to ' . $baseline . ', but it\'s not.');
        }

        self::succeed();
    }

    public function toBeGreaterThanOrEqual(int|float $baseline): void
    {
        $isGreaterThanOrEqualToBaseline = $this->value >= $baseline;

        if ($this->inverse && $isGreaterThanOrEqualToBaseline) {
            self::fail('Expected ' . $this->value . ' not to be greater than or equal to ' . $baseline . ', but it is.');
        }

        if (!$this->inverse && !$isGreaterThanOrEqualToBaseline) {
            self::fail('Expected ' . $this->value . ' to be greater than or equal to ' . $baseline . ', but it\'s not.');
        }

        self::succeed();
    }

    public function toBeAnArray(): void
    {
        if ($this->inverse) {
            if (is_array($this->value)) {
                self::fail('Expected value not to be an array, got ' . Exporter::export($this->value) . '.');
            }

            self::succeed();
            return;
        }

        if (!is_array($this->value)) {
            self::fail('Expected value to be an array, got ' . Exporter::export($this->value) . '.');
        }

        self::succeed();
    }

    public function toContainAnyOf(array $items): void
    {
        $containsAtLeastOne = false;

        foreach ($items as $item) {
            try {
                self::assertContains($item, $this->value);

                $containsAtLeastOne = true;
            } catch (AssertionFailedError $error) {
            }
        }

        if ($this->inverse) {
            if ($containsAtLeastOne) {
                self::fail('Expected array not to contain any of the expected items ' . Exporter::export($items) . ', but it does: ' . Exporter::export($this->value));
            }

            self::succeed();
            return;
        }

        if (!$containsAtLeastOne) {
            self::fail('Expected array to contain any of the expected items ' . Exporter::export($items) . ', but it does not: ' . Exporter::export($this->value));
        }

        self::succeed();
    }

    public function toContainAllOf(array $items): void
    {
        $containsAll = true;

        foreach ($items as $item) {
            try {
                self::assertContains($item, $this->value);
            } catch (AssertionFailedError $error) {
                $containsAll = false;
            }
        }

        if ($this->inverse) {
            if ($containsAll) {
                throw new AssertionFailedError('Failed asserting that the array does not contain all of the expected values.');
            }

            return;
        }

        if (!$containsAll) {
            throw new AssertionFailedError('Failed asserting that the array contains all of the expected values.');
        }
    }

    /**
     * @param class-string<Throwable> $class
     */
    public function toBeInstanceOf(string $class): void
    {
        $isInstanceOfExpectedClass = $this->value instanceof $class;
        if ($this->inverse && $isInstanceOfExpectedClass) {
            self::fail('Expected ' . get_class($this->value) . ' not to be an instance of ' . $class . ', but it is.');
        }

        if (!$this->inverse && !$isInstanceOfExpectedClass) {
            self::fail('Expected ' . get_class($this->value) . ' to be an instance of ' . $class . ', but it\'s not.');
        }

        self::succeed();
    }

    /**
     * @param class-string<Throwable>|null $class
     */
    public function toThrow(?string $class = null): WithMessageSupplement
    {
        $errorWasThrown = false;
        $correctErrorWasThrown = false;
        $thrownError = null;

        if ($this->exception) {
            $errorWasThrown = true;
            $thrownError = $this->exception;
        } else {
            try {
                $this->value->__invoke();
            } catch (Throwable $error) {
                $errorWasThrown = true;
                $thrownError = $error;

                if ($class !== null) {
                    $correctErrorWasThrown = $error instanceof $class;
                }
            }
        }


        if ($this->inverse) {
            if ($errorWasThrown && $class !== null && !$correctErrorWasThrown) {
                self::succeed();
                return new ErroredWithMessageSupplement();
            }

            if ($errorWasThrown && isset($error) && $error instanceof Throwable) {
                self::fail('Expected no exception to be thrown, ' . $error::class . ' was thrown.');
            }

            if ($errorWasThrown && !$correctErrorWasThrown && isset($this->exception)) {
                self::fail('Expected no exception to be thrown, ' . $this->exception::class . ' was thrown.');
            }

            self::succeed();
            return new ErroredWithMessageSupplement();
        }

        if (!$errorWasThrown && $class !== null) {
            self::fail('Expected ' . $class . ' to be thrown, but no exception was thrown.');
        }

        if (!$errorWasThrown) {
            self::fail('Expected an exception to be thrown, but no exception was thrown.');
        }

        if ($class !== null && isset($error) && !$correctErrorWasThrown) {
            self::fail('Expected ' . $class . ' to be thrown, but ' . $error::class . ' was thrown.');
        }

        self::succeed();
        return new ValidWithMessageSupplement(
            exception: $thrownError,
            succeed: fn () => self::succeed(),
            fail: fn (string $message) => self::fail($message)
        );
    }

    private function succeed(): void
    {
        self::assertTrue(true);
    }

    /**
     * @param class-string<Throwable>|null $class
     */
    public function toHaveThrown(?string $class = null): WithMessageSupplement
    {
        return $this->toThrow($class);
    }

    public function not(): static
    {
        $this->inverse = true;

        return $this;
    }
}
