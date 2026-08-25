<?php

declare(strict_types=1);

use Illuminate\Support\Str;
use Modules\Xot\Actions\Cast\SafeStringCastAction;
use Modules\Xot\Tests\TestCase;
use PHPUnit\Framework\Assert;

uses(TestCase::class);

it('casts various values to string correctly', function (): void {
    $action = app(SafeStringCastAction::class);

    Assert::assertSame('test', $action->execute('test'));
    Assert::assertSame('', $action->execute(null));
    Assert::assertSame('1', $action->execute(true));
    Assert::assertSame('0', $action->execute(false));
    Assert::assertSame('123', $action->execute(123));
    Assert::assertSame('1.23', $action->execute(1.23));
    // Non-scalar
    Assert::assertSame('', $action->execute(['a']));
    Assert::assertSame('', $action->execute(new stdClass));
});

it('uses static string cast method correctly', function (): void {
    Assert::assertSame('456', SafeStringCastAction::cast(456));
});

it('preserves the text of objects convertible to string', function (): void {
    $action = app(SafeStringCastAction::class);

    $stringable = new class implements Stringable
    {
        public function __toString(): string
        {
            return 'from-stringable';
        }
    };

    $legacy = new class
    {
        public function __toString(): string
        {
            return 'from-tostring';
        }
    };

    Assert::assertSame('from-stringable', $action->execute($stringable));
    Assert::assertSame('from-tostring', $action->execute($legacy));
    Assert::assertSame('2026-08-06', $action->execute(Str::of('2026-08-06')));
});

it('returns empty string for objects the native cast could not convert', function (): void {
    $action = app(SafeStringCastAction::class);

    Assert::assertSame('', $action->execute(new stdClass));
    Assert::assertSame('', $action->execute(['a']));
});
