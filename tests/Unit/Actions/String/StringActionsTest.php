<?php

declare(strict_types=1);

use Modules\Xot\Actions\String\GetPronounceablePasswordAction;
use Modules\Xot\Actions\String\GetStrBetweenStartsWithAction;
use Modules\Xot\Actions\String\NormalizeDriverNameAction;
use Modules\Xot\Actions\String\SanitizeAction;
use Modules\Xot\Tests\TestCase;
use PHPUnit\Framework\Assert;

uses(TestCase::class);

test('get pronounceable password action works', function () {
    $action = app(GetPronounceablePasswordAction::class);
    $password = $action->execute(12);

<<<<<<< HEAD
   Assert::assertGreaterThanOrEqual(8, strlen($password)); // min length logic inside
=======
    Assert::assertGreaterThanOrEqual(8, strlen($password)); // min length logic inside
>>>>>>> laraxot/dev
    // Should contain at least one digit and some characters from the special set
    Assert::assertMatchesRegularExpression('/[0-9]/', (string) $password);
});

test('get str between starts with action works', function () {
    $action = app(GetStrBetweenStartsWithAction::class);
    $body = 'prefix { content { inner } } suffix';
    $result = $action->execute($body, 'content', '{', '}');

<<<<<<< HEAD
   Assert::assertStringContainsString((string) 'content { inner }', (string) $result);
=======
    Assert::assertStringContainsString((string) 'content { inner }', (string) $result);
>>>>>>> laraxot/dev
});

test('normalize driver name action works', function () {
    $action = app(NormalizeDriverNameAction::class);
<<<<<<< HEAD
   Assert::assertSame('360dialog', $action->execute('360-Dialog'));
=======
    Assert::assertSame('360dialog', $action->execute('360-Dialog'));
>>>>>>> laraxot/dev
    Assert::assertSame('mydriver', $action->execute('My_Driver'));
});

test('sanitize action works', function () {
    $action = app(SanitizeAction::class);
    $input = '  <p>Hello &amp; World</p>  ';
<<<<<<< HEAD
   Assert::assertSame('Hello & World', $action->execute($input));
=======
    Assert::assertSame('Hello & World', $action->execute($input));
>>>>>>> laraxot/dev
});
