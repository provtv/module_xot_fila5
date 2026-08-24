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

<<<<<<< .merge_file_is3ycb
beforeEach(function (): void { $this->markTestSkipped('fragile offline mocks File/Module/DB'); });
=======
beforeEach(function (): void {
    $this->markTestSkipped('fragile offline mocks File/Module/DB');
});
>>>>>>> .merge_file_kcRZGb

it('resolves model types correctly', function (): void {
    Config::set('morph_map', ['log' => Log::class]);

    $classAction = app(GetModelClassByModelTypeAction::class);
    Assert::assertSame(Log::class, $classAction->execute('log'));

    $typeAction = app(GetModelTypeByModelAction::class);
<<<<<<< .merge_file_is3ycb
    $result = $typeAction->execute(new class extends Log implements ModelContract {});
=======
    $result = $typeAction->execute(new class extends Log implements ModelContract {
    });
>>>>>>> .merge_file_kcRZGb
    Assert::assertNotEmpty($result);
});
