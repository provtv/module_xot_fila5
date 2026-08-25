<?php

declare(strict_types=1);

use Illuminate\Support\Facades\File;
use Modules\Xot\Actions\File\GetClassNameByPathAction;
use Modules\Xot\Tests\TestCase;
use PHPUnit\Framework\Assert;

use function Safe\tempnam;

uses(TestCase::class);

it('gets class name from path correctly', function (): void {
    $tempFile = tempnam(sys_get_temp_dir(), 'test_class_');
    $tempPath = $tempFile.'.php';
    $content = "<?php\n\nnamespace My\\Test\\Namespace;
\n\nclass MyTestClass {}\n";
    File::put($tempPath, $content);

    $action = app(GetClassNameByPathAction::class);
    $result = $action->execute($tempPath);

<<<<<<< HEAD
   Assert::assertSame('My\\Test\\Namespace\\MyTestClass', $result);
=======
    Assert::assertSame('My\\Test\\Namespace\\MyTestClass', $result);
>>>>>>> laraxot/dev
    File::delete($tempPath);
});

it('gets class name from path without namespace correctly', function (): void {
<<<<<<< HEAD
   $tempFile = tempnam(sys_get_temp_dir(), 'test_class_no_ns_');
=======
    $tempFile = tempnam(sys_get_temp_dir(), 'test_class_no_ns_');
>>>>>>> laraxot/dev
    $tempPath = $tempFile.'.php';
    $content = "<?php\n\nclass MyNoNsClass {}\n";
    File::put($tempPath, $content);

    $action = app(GetClassNameByPathAction::class);
    $result = $action->execute($tempPath);

<<<<<<< HEAD
   Assert::assertSame('MyNoNsClass', $result);
=======
    Assert::assertSame('MyNoNsClass', $result);
>>>>>>> laraxot/dev
    File::delete($tempPath);
});
