<?php

declare(strict_types=1);

use Modules\Xot\Tests\TestCase;

uses(TestCase::class)->group('no-xot-db');

it('boots laravel application container', function (): void {
    expect(app()->bound('config'))->toBeTrue();
});
