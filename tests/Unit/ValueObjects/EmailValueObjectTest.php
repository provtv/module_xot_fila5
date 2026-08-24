<?php

declare(strict_types=1);

use Modules\Xot\Tests\TestCase;
use Modules\Xot\ValueObjects\EmailValueObject;
use PHPUnit\Framework\Assert;

uses(TestCase::class)->group('no-xot-db');

it('accepts valid email', function (): void {
    $email = 'test@example.com';
    $vo = new EmailValueObject($email);
    Assert::assertSame($email, $vo->email);
});

it('throws on invalid email', function (): void {
    expect(fn (): EmailValueObject => new EmailValueObject('not-an-email'))
        ->toThrow(InvalidArgumentException::class);
});
