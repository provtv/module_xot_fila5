<?php

declare(strict_types=1);

use Modules\Xot\Tests\TestCase;
use Modules\Xot\ValueObjects\PhoneValueObject;
use PHPUnit\Framework\Assert;

uses(TestCase::class);

it('accepts valid phone', function (): void {
    $phone = '+11234567890';
    $vo = PhoneValueObject::fromString($phone);
    Assert::assertSame($phone, $vo->toString());
});

it('throws on invalid phone', function (): void {
    // Il formato accettato e' `+1` seguito da dieci cifre: qui ne mancano.
    expect(static fn (): PhoneValueObject => PhoneValueObject::fromString('+1123'))
        ->toThrow(InvalidArgumentException::class, 'It is not valid phone value');
});
