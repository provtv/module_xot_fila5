<?php

declare(strict_types=1);

namespace Modules\Xot\Tests\Unit\Helpers;

use Modules\Xot\Helpers\PathHelper;
use Modules\Xot\Tests\XotBaseTestCase;

uses(XotBaseTestCase::class);

it('costruisce il path del modulo', function (): void {
    $basePath = PathHelper::$modulesBasePath;

    $result = PathHelper::modulePath('User');

    expect($result)->toContain('User')
        ->and($result)->toContain('Modules')
        ->and($result)->toBe($basePath.'/User');
});

it('costruisce il path dei models', function (): void {
    $result = PathHelper::modelsPath('User');

    expect($result)->toContain('User')
        ->and($result)->toContain('Models')
        ->and($result)->toEndWith('/Models');
});

it('costruisce il path delle migrations', function (): void {
    expect(PathHelper::migrationsPath('User'))->toContain('database/migrations');
});

it('costruisce il path dei controllers', function (): void {
    $result = PathHelper::controllersPath('User');

    expect($result)->toContain('Controllers')
        ->and($result)->toContain('Http');
});

it('costruisce il path dei seeders', function (): void {
    expect(PathHelper::seedersPath('Media'))->toContain('seeders');
});

it('costruisce il path dei providers', function (): void {
    expect(PathHelper::providersPath('Xot'))->toContain('Providers');
});

it('costruisce il path delle views', function (): void {
    $result = PathHelper::viewsPath('UI');

    expect($result)->toContain('views')
        ->and($result)->toContain('resources');
});

it('costruisce il path delle risorse Filament', function (): void {
    $result = PathHelper::filamentResourcesPath('User');

    expect($result)->toContain('Filament')
        ->and($result)->toContain('Resources');
});

it('accetta un path nel formato corretto', function (): void {
    expect(PathHelper::isValidPath('/var/www/html/project/laravel/Modules/User/app/Models'))->toBeTrue();
});

it('rifiuta un path Modules privo del segmento laravel', function (): void {
    expect(PathHelper::isValidPath('/var/www/html/project/Modules/User/app/Models'))->toBeFalse();
});

it('accetta un path generico non legato ai moduli', function (): void {
    expect(PathHelper::isValidPath('/var/www/generic/path'))->toBeTrue();
});

it('corregge un path con prefisso errato', function (): void {
    $corrected = PathHelper::correctPath('/var/www/html/Modules/User/Models');

    expect($corrected)->toContain(PathHelper::$modulesBasePath)
        ->and($corrected)->not->toContain('/var/www/html/Modules/');
});

it('lascia invariato un path gia valido', function (): void {
    $validPath = '/var/www/html/project/laravel/Modules/User';

    expect(PathHelper::correctPath($validPath))->toBe($validPath);
});

it('rifiuta un modulo inesistente', function (): void {
    expect(PathHelper::moduleExists('__missing_module__'))->toBeFalse();
});

it('restituisce array vuoto se il base path dei moduli non esiste', function (): void {
    expect(PathHelper::getModules())->toBe([]);
});
