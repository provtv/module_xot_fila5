<?php

declare(strict_types=1);

use Illuminate\Support\Facades\File;
use Modules\Xot\Actions\Arr\SaveArrayAction;
use Modules\Xot\Tests\TestCase;
use PHPUnit\Framework\Assert;

use function Safe\json_decode;
use function Safe\tempnam;

uses(TestCase::class)->group('no-xot-db');

test('save array action saves as php by default', function () {
    $data = ['foo' => 'bar'];
    $filename = tempnam(sys_get_temp_dir(), 'test_save_array_php').'.php';

    $action = app(SaveArrayAction::class);
    $result = $action->execute($data, $filename);

    Assert::assertTrue($result);
    $savedData = include $filename;
    Assert::assertSame($data, $savedData);
    File::delete($filename);
});

test('save array action saves as json', function () {
    $data = ['foo' => 'bar'];
    $filename = tempnam(sys_get_temp_dir(), 'test_save_array_json').'.json';

    $action = app(SaveArrayAction::class);
    $result = $action->execute($data, $filename, 'json');

    Assert::assertTrue($result);
    $savedData = json_decode(File::get($filename), true);
    Assert::assertSame($data, $savedData);
    File::delete($filename);
});

test('save array action throws exception for unsupported format', function (): void {
    $action = app(SaveArrayAction::class);
    expect(static fn (): bool => $action->execute(['foo' => 'bar'], 'file.txt', 'xml'))
        ->toThrow(InvalidArgumentException::class);
});
