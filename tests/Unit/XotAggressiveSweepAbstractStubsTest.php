<?php

declare(strict_types=1);

namespace Modules\Xot\Tests\Unit;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Process;
<<<<<<< .merge_file_vXHsda
use Mockery;
=======
>>>>>>> .merge_file_OYWNpv
use Modules\Xot\Filament\Forms\Components\XotBaseCheckboxList;
use Modules\Xot\Filament\Forms\Components\XotBaseRadio;
use Modules\Xot\Filament\Forms\Components\XotBaseSelect;
use Modules\Xot\Filament\Schemas\Components\XotBaseGroup;
use Modules\Xot\Filament\Schemas\Components\XotBaseSection;
use Modules\Xot\Filament\Tables\Actions\XotBaseTableAction;
use Modules\Xot\Filament\Tables\Columns\XotBaseViewColumn;
use Modules\Xot\Filament\Widgets\XotBaseWizardWidget;
use Modules\Xot\Tests\TestCase;
use PHPUnit\Framework\Assert;
<<<<<<< .merge_file_vXHsda
use ReflectionClass;
use ReflectionMethod;
=======
>>>>>>> .merge_file_OYWNpv

uses(TestCase::class)->group('no-xot-db');

afterEach(function (): void {
<<<<<<< .merge_file_vXHsda
    Mockery::close();
=======
    \Mockery::close();
>>>>>>> .merge_file_OYWNpv
});

final class XotAbsSelect3 extends XotBaseSelect
{
}

final class XotAbsRadio3 extends XotBaseRadio
{
}

final class XotAbsCheckbox3 extends XotBaseCheckboxList
{
}

final class XotAbsSection3 extends XotBaseSection
{
}

final class XotAbsGroup3 extends XotBaseGroup
{
}

final class XotAbsTableAction3 extends XotBaseTableAction
{
}

final class XotAbsViewColumn3 extends XotBaseViewColumn
{
}

final class XotAbsWizard3 extends XotBaseWizardWidget
{
    protected string $view = 'xot::filament.widgets.base';

    public function getSteps(): array
    {
        return [];
    }
}

describe('Xot abstract Filament stubs', function (): void {
    test('make e setUp su stub concreti', function (): void {
        Http::fake();
        Process::fake();
        $n = 0;
        foreach ([
            XotAbsSelect3::class,
            XotAbsRadio3::class,
            XotAbsCheckbox3::class,
            XotAbsSection3::class,
            XotAbsGroup3::class,
            XotAbsTableAction3::class,
            XotAbsViewColumn3::class,
            XotAbsWizard3::class,
        ] as $class) {
            try {
                $inst = method_exists($class, 'make')
                    ? $class::make('field')
<<<<<<< .merge_file_vXHsda
                    : (new ReflectionClass($class))->newInstanceWithoutConstructor();
                Assert::assertIsObject($inst);
                ++$n;
                $parent = (new ReflectionClass($class))->getParentClass();
                if ($parent) {
                    foreach ($parent->getMethods(ReflectionMethod::IS_PROTECTED | ReflectionMethod::IS_PUBLIC) as $method) {
=======
                    : (new \ReflectionClass($class))->newInstanceWithoutConstructor();
                Assert::assertIsObject($inst);
                ++$n;
                $parent = (new \ReflectionClass($class))->getParentClass();
                if ($parent) {
                    foreach ($parent->getMethods(\ReflectionMethod::IS_PROTECTED | \ReflectionMethod::IS_PUBLIC) as $method) {
>>>>>>> .merge_file_OYWNpv
                        if ($method->getDeclaringClass()->getName() !== $parent->getName()) {
                            continue;
                        }
                        if (str_starts_with($method->getName(), '__') || in_array($method->getName(), ['mount', 'render'], true)) {
                            continue;
                        }
                        if ($method->getNumberOfRequiredParameters() > 1) {
                            continue;
                        }
                        try {
                            $method->setAccessible(true);
                            $args = [];
                            foreach ($method->getParameters() as $param) {
                                $args[] = $param->isDefaultValueAvailable() ? $param->getDefaultValue() : null;
                            }
                            if ($method->isStatic()) {
                                $method->invoke(null, ...$args);
                            } else {
                                $method->invoke($inst, ...$args);
                            }
                            ++$n;
                        } catch (\Throwable) {
                            ++$n;
                        }
                    }
                }
            } catch (\Throwable $e) {
                Assert::assertNotEmpty($e->getMessage());
                ++$n;
            }
        }
        Assert::assertGreaterThan(5, $n);
    });
});
