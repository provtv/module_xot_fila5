<?php

declare(strict_types=1);

use Modules\Xot\Actions\Arr\DiffAssocRecursiveAction;
use Modules\Xot\Tests\TestCase;
use PHPUnit\Framework\Assert;

uses(TestCase::class)->group('no-xot-db');

it('calculates recursive diff correctly', function (): void {
    $arr1 = [
        'a' => ['id' => 1, 'name' => 'Test'],
        'b' => ['id' => 2, 'name' => 'Test 2'],
    ];
    $arr2 = [
        'a' => ['id' => 1, 'name' => 'Test'],
    ];

    $action = app(DiffAssocRecursiveAction::class);
    $result = $action->execute($arr1, $arr2);

    Assert::assertSame(['id' => 2, 'name' => 'Test 2'], $result['b']);
    Assert::assertArrayHasKey('b', $result);
});

it('handles numeric strings in diff', function (): void {
    $arr1 = [
        'a' => ['id' => '1', 'name' => 'Test'],
    ];
    $arr2 = [
        'a' => ['id' => 1, 'name' => 'Test'],
    ];

    $action = app(DiffAssocRecursiveAction::class);
    $result = $action->execute($arr1, $arr2);

    Assert::assertEmpty($result);
});

it('throws exception for non-array items in fixType', function (): void {
    expect(static fn (): array => DiffAssocRecursiveAction::fixType(['a' => 'not-an-array']))
        ->toThrow(Exception::class);
});
