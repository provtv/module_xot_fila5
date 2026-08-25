<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;
use Modules\Xot\Actions\ArtisanAction;
use Modules\Xot\Tests\TestCase;

use function Safe\ob_end_clean;
use function Safe\ob_start;

uses(TestCase::class);

beforeEach(function (): void {
    // Configure mysql connection for tests (required by ArtisanService)
    Config::set('database.connections.mysql', [
        'driver' => 'sqlite',
        'database' => ':memory:',
        'prefix' => '',
    ]);
});

test('artisan service act method returns empty string for unknown commands', function (): void {
    Request::replace(['module' => '']);

<<<<<<< HEAD
   $result = ArtisanAction::act('unknown-command');
=======
    $result = ArtisanAction::act('unknown-command');
>>>>>>> laraxot/dev

    expect($result)->toBe('');
});

test('artisan service act method handles migrate command', function (): void {
    Request::replace(['module' => '']);

    // Mock Artisan facade - DB::purge() and DB::reconnect() work with configured connection
    Artisan::shouldReceive('call')->once()->andReturn(0);
    Artisan::shouldReceive('output')->once()->andReturn('Migration completed');

<<<<<<< HEAD
   $result = ArtisanAction::act('migrate');
=======
    $result = ArtisanAction::act('migrate');
>>>>>>> laraxot/dev

    expect(str_contains($result, 'Migration completed'))->toBeTrue();
});

test('artisan service act method handles module parameter', function (): void {
    Request::replace(['module' => 'TestModule']);

    Artisan::shouldReceive('call')->once()->andReturn(0);
    Artisan::shouldReceive('output')->once()->andReturn('Module migration');

    ob_start();
<<<<<<< HEAD
   $result = ArtisanAction::act('migrate');
=======
    $result = ArtisanAction::act('migrate');
>>>>>>> laraxot/dev
    ob_end_clean();

    expect(str_contains($result, 'Module migration'))->toBeTrue();
});

test('artisan service handles non-string module parameter', function (): void {
    Request::replace(['module' => ['not', 'a', 'string']]);

    Artisan::shouldReceive('call')->once()->andReturn(0);
    Artisan::shouldReceive('output')->once()->andReturn('Migration');

<<<<<<< HEAD
   $result = ArtisanAction::act('migrate');
=======
    $result = ArtisanAction::act('migrate');
>>>>>>> laraxot/dev

    expect(str_contains($result, 'Migration'))->toBeTrue();
});
