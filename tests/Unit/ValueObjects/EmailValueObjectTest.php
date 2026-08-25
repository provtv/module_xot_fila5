<?php

declare(strict_types=1);

use Modules\Xot\Tests\TestCase;
use Modules\Xot\ValueObjects\EmailValueObject;
use PHPUnit\Framework\Assert;

uses(TestCase::class);

it('accepts valid email', function (): void {
    $email = 'test@example.com';
    $vo = new EmailValueObject($email);
<<<<<<< HEAD
   Assert::assertSame($email, $vo->email);
=======
    Assert::assertSame($email, $vo->email);
>>>>>>> laraxot/dev
});

it('throws on invalid email', function (): void {
    expect(static fn (): EmailValueObject => new EmailValueObject('non-e-una-email'))
        ->toThrow(InvalidArgumentException::class);
});
