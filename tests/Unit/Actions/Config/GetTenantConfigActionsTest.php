<?php

declare(strict_types=1);

namespace Modules\Xot\Tests\Unit\Actions\Config;

use Illuminate\Support\Facades\File;
use Modules\Xot\Actions\Config\GetTenantConfigArrayAction;
use Modules\Xot\Actions\Config\GetTenantConfigPathAction;
use Modules\Xot\Tests\TestCase;
use PHPUnit\Framework\Assert;

use function Safe\tempnam;

uses(TestCase::class)->group('no-xot-db');

describe('Get Tenant Config Actions', function (): void {
    test('gets tenant config array correctly', function (): void {
        $configName = 'test_config';
        $tempPath = tempnam(sys_get_temp_dir(), 'test_config_').'.php';
        $configData = ['key' => 'value'];

        File::put($tempPath, '<?php return '.var_export($configData, true).';');

        $pathMock = $this->createUnitMock(GetTenantConfigPathAction::class);
        $pathMock->expects($this->once())
            ->method('execute')
            ->with($configName)
            ->willReturn($tempPath);

        app()->instance(GetTenantConfigPathAction::class, $pathMock);

        $result = (new GetTenantConfigArrayAction())->execute($configName);

        Assert::assertSame($configData, $result);
        File::delete($tempPath);
    });

    test('returns empty array if tenant config file does not exist', function (): void {
        $pathMock = $this->createUnitMock(GetTenantConfigPathAction::class);
        $pathMock->method('execute')->willReturn('/path/to/nothing.php');
        app()->instance(GetTenantConfigPathAction::class, $pathMock);

        $result = (new GetTenantConfigArrayAction())->execute('non_existent');

        Assert::assertSame([], $result);
    });
});
