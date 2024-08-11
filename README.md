# 📦 Phluent

Make your tests read the same way you speak.

## 🌟 Highlights

- Write your tests in the same way you speak
- Makes tests easier to understand
- Improves collaboration and communication


## ℹ️ Overview

Phluent is an assertion library for PHPUnit. It's API design mimics how we speak as humans, this way it's easier
for you and your team members to understand what the test is doing.

Compare the two assertions below, the first is using PHPUnit's Assert class and the other example uses Phluent.

```php
self::assertToBeGreaterThan(4, 3)
```

```php
Expect(4)->toBeGreaterThan(3);
```

The latter example is much easier to read and understand.


### ✍️ Authors

Hello, I'm Nils Haberkamp. I strongly believe that writing better tests makes one a better developer, leads to better
communication and collaboration and overall a better software. This package is my take on creating better tests.


## 🚀 Usage

```php
use PHPUnit\Framework\TestCase;
use function Phluent\Expect;

class SomeTest extends TestCase {
    public function test_one_plus_one_equals_two(): void
    {
        $result = 1 + 1;

        Expect($result)->toBe(2);
    }
}
```

<details>
<summary>Available assertions</summary>

* toBeEmpty
* toBe
* toBeAnInteger
* toBeNegative
* toBeInBetween
* toBePositive
* toBeGreaterThan
* toBeLessThan
* toBeAFloat
* toBeLessThanOrEqual
* toBeGreaterThanOrEqual
* toBeAString
* toBeEmpty
* toStartWith
* toEndWith
* toBeABoolean
* toBeAnArray
* toBeInstanceOf
* toBeNull
* toBeFalse
* toBeTrue
* toContainAllOf
* toContainAnyOf
* toContain
* toHaveALengthOf
</details>


## ⬇️ Installation

First, install the package via composer:

```bash
composer require --dev phluent/phluent
```

Now you need to include phluent in your autoloader. To do this open
the file that bootstraps PHPUnit. (This file is often located under: `tests/bootstrap.php`)
Open the file and add the following code:

```php
require dirname(__DIR__) . '/vendor/phluent/phluent/src/Expect.php';
require dirname(__DIR__) . '/vendor/phluent/phluent/src/Act.php';
```

The installation is now complete, and you're all set.

Requirements:

* PHP 7.4 or higher
* PHPUnit 9.0 or higher


## 💭 Feedback and Contributing

Thank you for taking an interest in contributing to this project. Feel free to open an [issue](https://github.com/Haberkamp/phluent/issues/new)
or a pull request if you have any suggestions or improvements.


## 🏅 Thank you

I want to thank the people who contributed to the following projects. Without them, this project would
not exist.

* [Fluent Assertions](https://github.com/fluentassertions/fluentassertions)
* [jest-extended](https://github.com/jest-community/jest-extended)
* [expect-more-jest](https://github.com/JamieMason/expect-more/tree/master/packages/expect-more-jest)

Special thanks to the maintainers and contributors of [PHPUnit](https://github.com/sebastianbergmann/phpunit)
for creating such an awesome project.
