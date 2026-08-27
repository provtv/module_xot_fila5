<?php

declare(strict_types=1);

namespace Modules\Xot\ValueObjects;

<<<<<<< HEAD
=======
use InvalidArgumentException;
>>>>>>> laraxot/master
use function Safe\preg_match;

/**
 * @see https://medium.com/@sliusarchyn/value-objects-in-laravel-use-it-12ba71b00281
 */
readonly class PhoneValueObject
{
    private function __construct(
<<<<<<< HEAD
        private string $phone,
    ) {
    }
=======
        private  string $phone,
    ) {}
>>>>>>> laraxot/master

    public static function fromString(string $phone): self
    {
        if (0 === preg_match('/^\+1\d{10}$/', $phone)) {
<<<<<<< HEAD
            throw new \InvalidArgumentException('It is not valid phone value');
=======
            throw new InvalidArgumentException('It is not valid phone value');
>>>>>>> laraxot/master
        }

        return new self($phone);
    }

    public function toString(): string
    {
        return $this->phone;
    }
}
