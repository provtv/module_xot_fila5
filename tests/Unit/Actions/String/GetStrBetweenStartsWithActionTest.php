<?php

declare(strict_types=1);

use Modules\Xot\Actions\String\GetStrBetweenStartsWithAction;
use Modules\Xot\Tests\TestCase;
use PHPUnit\Framework\Assert;

uses(TestCase::class);

it('extracts string between markers correctly', function (): void {
    $action = app(GetStrBetweenStartsWithAction::class);

    $body = 'prefix { content { inner } } suffix';
    $result = $action->execute($body, 'content', '{', '}');

<<<<<<< HEAD
   Assert::assertSame('content { inner }', $result);
=======
    Assert::assertSame('content { inner }', $result);
>>>>>>> laraxot/dev
});

it('throws exception when start marker is missing', function (): void {
    $action = app(GetStrBetweenStartsWithAction::class);
});
