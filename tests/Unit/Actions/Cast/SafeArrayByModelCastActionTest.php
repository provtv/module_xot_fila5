<?php

declare(strict_types=1);

namespace Modules\Xot\Tests\Unit\Actions\Cast;

use Modules\Activity\Models\Activity;
use Modules\Xot\Actions\Cast\SafeArrayByModelCastAction;
use Modules\Xot\Tests\Fixtures\Models\BrokenAttributesModelForSafeArrayCast;
use Modules\Xot\Tests\TestCase;
use PHPUnit\Framework\Assert;

uses(TestCase::class);

describe('Safe Array By Model Cast Action', function (): void {
    test('converts model attributes to array correctly', function (): void {
        $model = new Activity();
        $model->setRawAttributes(['name' => 'Test']);

        $action = app(SafeArrayByModelCastAction::class);
        $result = $action->execute($model);

        Assert::assertNotEmpty($result);
        Assert::assertArrayHasKey('name', $result);
    });

    test('falls back to safe execute on error', function (): void {
        $model = new BrokenAttributesModelForSafeArrayCast();

        $action = app(SafeArrayByModelCastAction::class);
        $result = $action->execute($model);

        Assert::assertNotEmpty($result);
        Assert::assertArrayHasKey('name', $result);
        Assert::assertSame('Fallback', $result['name']);
    });
});
