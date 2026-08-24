<?php

declare(strict_types=1);

namespace Modules\Xot\Tests\Unit;

use Illuminate\Support\Facades\Validator;
use Modules\Xot\Rules\DateTimeRule;
use Modules\Xot\Tests\TestCase;
use PHPUnit\Framework\Assert;

uses(TestCase::class)->group('no-xot-db');

test('DateTimeRule accepts the documented day month year format', function (): void {
    $validator = Validator::make(
        ['published_at' => '10/10/2019 13:43'],
        ['published_at' => [new DateTimeRule()]],
    );

    Assert::assertFalse($validator->fails());
});

test('DateTimeRule rejects values outside the documented format', function (mixed $value): void {
    $validator = Validator::make(
        ['published_at' => $value],
        ['published_at' => [new DateTimeRule()]],
    );

    Assert::assertTrue($validator->fails());
    Assert::assertStringContainsString('not a valid datetime', $validator->errors()->first('published_at'));
})->with([
    'non-string value' => 123,
    'invalid calendar date' => '2024-13-99 25:99',
]);
