<?php

declare(strict_types=1);

namespace Modules\Xot\Tests\Unit\Actions\File;

use Illuminate\Support\Facades\File;
use Modules\Xot\Actions\File\AssetAction;
use Modules\Xot\Actions\File\AssetPathAction;
use Modules\Xot\Tests\TestCase;
use Nwidart\Modules\Facades\Module;
use PHPUnit\Framework\Assert;

uses(TestCase::class);

it('handles absolute urls in AssetAction', function (): void {
    $action = app(AssetAction::class);
    $url = 'https://example.com/asset.js';
    Assert::assertSame($url, $action->execute($url));
});

it('returns path if asset already exists in public folder', function (): void {
    $path = 'css/app.css';
    File::partialMock()->shouldReceive('exists')->with(public_path($path))->andReturnTrue();

    Assert::assertSame($path, app(AssetAction::class)->execute($path));
});

it('calculates asset path correctly in AssetPathAction', function (): void {
    // Spy on Module facade
    Module::partialMock()->allows([
        'getModulePath' => function (string $module): string {
            return 'User' === $module ? '/path/to/User/' : '';
        },
    ]);

    $action = app(AssetPathAction::class);
    $result = $action->execute('User::js/app.js');

    Assert::assertSame('/path/to/User/resources/js/app.js', $result);
});
