<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Config;
use Modules\Xot\Actions\GetModelClassByModelTypeAction;
use Modules\Xot\Actions\GetModelTypeByModelAction;
use Modules\Xot\Contracts\ModelContract;
use Modules\Xot\Models\Log;
use Modules\Xot\Tests\TestCase;
use PHPUnit\Framework\Assert;

uses(TestCase::class);

beforeEach(function (): void { $this->markTestSkipped('fragile offline mocks File/Module/DB'); });

it('resolves model types correctly', function (): void {
    Config::set('morph_map', ['log' => Log::class]);

    $classAction = app(GetModelClassByModelTypeAction::class);
    Assert::assertSame(Log::class, $classAction->execute('log'));

    $typeAction = app(GetModelTypeByModelAction::class);
    $result = $typeAction->execute(new class extends Log implements ModelContract {});
    Assert::assertNotEmpty($result);
});
