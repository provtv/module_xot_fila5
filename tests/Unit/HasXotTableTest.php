<?php

declare(strict_types=1);

<<<<<<< HEAD
use Filament\Tables\Table;
use Mockery\MockInterface;
use Modules\Xot\Tests\TestCase;
use Modules\Xot\Tests\Unit\Support\DummyTestModel;
use Modules\Xot\Tests\Unit\Support\HasTableWithoutOptionalMethodsTestClass;
use Modules\Xot\Tests\Unit\Support\HasTableWithXotTestClass;
use PHPUnit\Framework\Assert;

uses(TestCase::class)->group('no-xot-db');

/**
 * @param  MockInterface&Table  $tableMock
 * @return MockInterface&Table
 */
function stubTableChain(MockInterface $tableMock): MockInterface
{
    $chainMethods = [
        'recordTitleAttribute',
        'heading',
        'columns',
        'contentGrid',
        'filters',
        'filtersLayout',
        'filtersFormColumns',
        'persistFiltersInSession',
        'headerActions',
        'actions',
        'bulkActions',
        'actionsPosition',
        'recordActions',
        'toolbarActions',
        'recordActionsPosition',
        'emptyStateActions',
        'striped',
        'paginated',
        'defaultSort',
        'poll',
    ];

    $allows = [];
    foreach ($chainMethods as $method) {
        $allows[$method] = $tableMock;
    }

    $tableMock->allows($allows);

    return $tableMock;
}

afterEach(function (): void {
    Mockery::close();
});

it('tests table method with all methods implemented', function (): void {
    Mockery::mock('overload:Modules\\Xot\\Actions\\Model\\TableExistsByModelClassActions')
        ->allows(['execute' => true]);

    /** @var HasTableWithXotTestClass&MockInterface $mock */
    $mock = Mockery::mock(HasTableWithXotTestClass::class)
        ->makePartial()
        ->shouldAllowMockingProtectedMethods();
    $mock->allows([
        'getXotTableHeaderActions' => [],
        'getXotTableActions' => [],
        'getXotTableBulkActions' => [],
        'getModelClass' => DummyTestModel::class,
        'getTableRecordTitleAttribute' => 'name',
        'getXotTableHeading' => 'Test Table',
        'getXotTableFilters' => [],
        'getTableFiltersFormColumns' => 1,
        'getXotTableEmptyStateActions' => [],
        'getXotDefaultTableSortColumn' => null,
        'getXotDefaultTableSortDirection' => null,
        'getTablePollInterval' => null,
    ]);

    /** @var MockInterface&Table $tableMock */
    $tableMock = Mockery::mock(Table::class);
    stubTableChain($tableMock);

    $result = $mock->table($tableMock);

    Assert::assertSame($tableMock, $result);
});

it('tests table method with no optional methods implemented', function (): void {
    Mockery::mock('overload:Modules\\Xot\\Actions\\Model\\TableExistsByModelClassActions')
        ->allows(['execute' => true]);

    /** @var HasTableWithoutOptionalMethodsTestClass&MockInterface $mock */
    $mock = Mockery::mock(HasTableWithoutOptionalMethodsTestClass::class)
        ->makePartial()
        ->shouldAllowMockingProtectedMethods();
    $mock->allows([
        'getModelClass' => DummyTestModel::class,
        'getTableRecordTitleAttribute' => 'name',
        'getXotTableHeading' => 'Test Table',
        'getXotTableFilters' => [],
        'getXotTableHeaderActions' => [],
        'getXotTableActions' => [],
        'getXotTableBulkActions' => [],
        'getTableFiltersFormColumns' => 1,
        'getXotTableEmptyStateActions' => [],
        'getXotDefaultTableSortColumn' => null,
        'getXotDefaultTableSortDirection' => null,
        'getTablePollInterval' => null,
    ]);

    /** @var MockInterface&Table $tableMock */
    $tableMock = Mockery::mock(Table::class);
    stubTableChain($tableMock);

    $result = $mock->table($tableMock);

    Assert::assertSame($tableMock, $result);
=======
namespace Modules\Xot\Tests\Unit;

use Tests\TestCase;
use Mockery;
use Filament\Tables\Table;
use Modules\Xot\Tests\Unit\Support\DummyTestModel;
use Modules\Xot\Tests\Unit\Support\HasTableWithoutOptionalMethodsTestClass;
use Modules\Xot\Tests\Unit\Support\HasTableWithXotTestClass;

uses(TestCase::class);

afterEach(function () {
    Mockery::close();
});
<<<<<<< .merge_file_sWb9Wu

it('tests table method with all methods implemented', function () {
    // Avoid DB/Schema access inside TableExistsByModelClassActions
    Mockery::mock('overload:Modules\\Xot\\Actions\\Model\\TableExistsByModelClassActions')
        ->shouldReceive('execute')
        ->andReturn(true);

    // Create partial mock and defer missing to real methods so trait's table() runs
    $mock = Mockery::mock(HasTableWithXotTestClass::class)->makePartial()->shouldDeferMissing();

    // Expect getTableHeaderActions to be called
    $mock->shouldReceive('getTableHeaderActions')->once()->andReturn([]);

    // Expect getTableActions to be called
    $mock->shouldReceive('getTableActions')->once()->andReturn([]);

    // Expect getTableBulkActions to be called
    $mock->shouldReceive('getTableBulkActions')->once()->andReturn([]);

    // Other required method stubs
    $mock->shouldReceive('getModelClass')->andReturn(DummyTestModel::class);
    $mock->shouldReceive('getTableRecordTitleAttribute')->andReturn('name');
    $mock->shouldReceive('getTableHeading')->andReturn('Test Table');
    $mock->shouldReceive('getTableFilters')->andReturn([]);
    // Stub optional methods to avoid resolving translator / actions
    $mock->shouldReceive('getTableHeaderActions')->andReturn([]);
    $mock->shouldReceive('getTableActions')->andReturn([]);
    $mock->shouldReceive('getTableBulkActions')->andReturn([]);
    $mock->shouldReceive('getTableFiltersFormColumns')->andReturn(1);
    $mock->shouldReceive('getTableEmptyStateActions')->andReturn([]);

    // Create a mock for Table
    $tableMock = Mockery::mock(Table::class);
    $tableMock->shouldReceive('recordTitleAttribute')->andReturnSelf();
    $tableMock->shouldReceive('heading')->andReturnSelf();
    $tableMock->shouldReceive('columns')->andReturnSelf();
    $tableMock->shouldReceive('contentGrid')->andReturnSelf();
    $tableMock->shouldReceive('filters')->andReturnSelf();
    $tableMock->shouldReceive('filtersLayout')->andReturnSelf();
    $tableMock->shouldReceive('filtersFormColumns')->andReturnSelf();
    $tableMock->shouldReceive('persistFiltersInSession')->andReturnSelf();
    $tableMock->shouldReceive('headerActions')->andReturnSelf();
    $tableMock->shouldReceive('actions')->andReturnSelf();
    $tableMock->shouldReceive('bulkActions')->andReturnSelf();
    $tableMock->shouldReceive('actionsPosition')->andReturnSelf();
    $tableMock->shouldReceive('emptyStateActions')->andReturnSelf();
    $tableMock->shouldReceive('striped')->andReturnSelf();
    $tableMock->shouldReceive('paginated')->andReturnSelf();

    // Call the table method
    $result = $mock->table($tableMock);

    // Assert the result is a Table instance
    expect($result)->toBe($tableMock);
});

it('tests table method with no optional methods implemented', function () {
    // Avoid DB/Schema access inside TableExistsByModelClassActions
    Mockery::mock('overload:Modules\\Xot\\Actions\\Model\\TableExistsByModelClassActions')
        ->shouldReceive('execute')
        ->andReturn(true);

    // Create partial mock and defer missing to real methods so trait's table() runs
    $mock = Mockery::mock(HasTableWithoutOptionalMethodsTestClass::class)->makePartial()->shouldDeferMissing();

    // Other required method stubs
    $mock->shouldReceive('getModelClass')->andReturn(DummyTestModel::class);
    $mock->shouldReceive('getTableRecordTitleAttribute')->andReturn('name');
    $mock->shouldReceive('getTableHeading')->andReturn('Test Table');
    $mock->shouldReceive('getTableFilters')->andReturn([]);
    // Avoid constructing Filament Actions which require translator binding
    $mock->shouldReceive('getTableHeaderActions')->andReturn([]);
    $mock->shouldReceive('getTableActions')->andReturn([]);
    $mock->shouldReceive('getTableBulkActions')->andReturn([]);
    $mock->shouldReceive('getTableFiltersFormColumns')->andReturn(1);
    $mock->shouldReceive('getTableEmptyStateActions')->andReturn([]);

    // Create a mock for Table
    $tableMock = Mockery::mock(Table::class);
    $tableMock->shouldReceive('recordTitleAttribute')->andReturnSelf();
    $tableMock->shouldReceive('heading')->andReturnSelf();
    $tableMock->shouldReceive('columns')->andReturnSelf();
    $tableMock->shouldReceive('contentGrid')->andReturnSelf();
    $tableMock->shouldReceive('filters')->andReturnSelf();
    $tableMock->shouldReceive('filtersLayout')->andReturnSelf();
    $tableMock->shouldReceive('filtersFormColumns')->andReturnSelf();
    $tableMock->shouldReceive('persistFiltersInSession')->andReturnSelf();
    // headerActions, actions, and bulkActions are called with empty arrays
    $tableMock->shouldReceive('headerActions')->andReturnSelf();
    $tableMock->shouldReceive('actions')->andReturnSelf();
    $tableMock->shouldReceive('bulkActions')->andReturnSelf();
    $tableMock->shouldReceive('actionsPosition')->andReturnSelf();
    $tableMock->shouldReceive('emptyStateActions')->andReturnSelf();
    $tableMock->shouldReceive('striped')->andReturnSelf();
    $tableMock->shouldReceive('paginated')->andReturnSelf();

    // Call the table method
    $result = $mock->table($tableMock);

    // Assert the result is a Table instance
    expect($result)->toBe($tableMock);
>>>>>>> laraxot/master
});
=======
>>>>>>> .merge_file_2TwTpm
