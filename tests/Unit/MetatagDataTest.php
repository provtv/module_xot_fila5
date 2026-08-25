<?php

declare(strict_types=1);

use Modules\Xot\Actions\PaDesignColorsAction;
use Modules\Xot\Datas\MetatagData;
use Modules\Xot\Tests\TestCase;
use PHPUnit\Framework\Assert;

uses(TestCase::class);

test('MetatagData puo essere istanziata', function () {
    $metatagData = new MetatagData();
    Assert::assertInstanceOf(MetatagData::class, $metatagData);
});

test('getFilamentColors restituisce i colori Filament corretti', function (): void {
    $metatagData = new MetatagData();
    $colors = $metatagData->getFilamentColors();

    Assert::assertArrayHasKey('danger', $colors);
    Assert::assertArrayHasKey('gray', $colors);
    Assert::assertArrayHasKey('info', $colors);
    Assert::assertArrayHasKey('primary', $colors);
    Assert::assertArrayHasKey('success', $colors);
    Assert::assertArrayHasKey('warning', $colors);
    Assert::assertIsString($colors['primary'][600] ?? null);
    Assert::assertEquals(app(PaDesignColorsAction::class)->filamentPalette(), $colors);
});

// `getColors()` e `getLogoHeight()` sono deprecati sui gemelli `getThemeColors()` e
// `getBrandLogoHeight()`: i test seguono l'API che sopravvive, altrimenti restano a
// coprire un metodo che sparira'. `getThemeColors()` appiattisce l'array annidato di
// `colors` in `array<string, string>`, quindi le chiavi restano ma i valori sono stringhe.
test('getThemeColors gestisce correttamente i colori personalizzati', function () {
    $metatagData = new MetatagData();
    $metatagData->colors = [
        'custom_color' => [
            'key' => 'custom_color',
            'color' => 'custom',
            'hex' => '#FF5500',
        ],
        'primary' => [
            'key' => 'primary',
            'color' => 'amber',
        ],
    ];

<<<<<<< HEAD
   $colors = $metatagData->getThemeColors();
=======
    $colors = $metatagData->getThemeColors();
>>>>>>> laraxot/dev

    Assert::assertSame('custom', $colors['custom_color']);
    Assert::assertSame('amber', $colors['primary']);
});

test('getBrandLogoHeight restituisce il valore corretto', function () {
    $metatagData = new MetatagData();
    $metatagData->logo_height = '3em';

    Assert::assertSame('3em', $metatagData->getBrandLogoHeight());
});

test('Le proprieta hanno i valori di default corretti', function () {
    $metatagData = new MetatagData();

    Assert::assertSame('xot', $metatagData->generator);
    Assert::assertSame('UTF-8', $metatagData->charset);
    Assert::assertSame('xot', $metatagData->author);
    Assert::assertSame('2em', $metatagData->logo_height);
    Assert::assertSame('/favicon.ico', $metatagData->favicon);
});
