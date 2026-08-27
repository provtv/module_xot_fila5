<?php

declare(strict_types=1);

use Modules\Xot\Actions\Cast\SafeFloatCastAction;
<<<<<<< HEAD
use Modules\Xot\Tests\TestCase;
use PHPUnit\Framework\Assert;

uses(TestCase::class)->group('no-xot-db');

it('casts float values', function (): void {
    $result = app(SafeFloatCastAction::class)->execute(123.45);
    Assert::assertSame(123.45, $result);
});

it('casts integer values', function (): void {
    $result = app(SafeFloatCastAction::class)->execute(123);
    Assert::assertSame(123.0, $result);
});

it('casts null values', function (): void {
    $result = app(SafeFloatCastAction::class)->execute(null);
    Assert::assertSame(0.0, $result);
});

it('casts null values with custom default', function (): void {
    $result = app(SafeFloatCastAction::class)->execute(null, 10.0);
    Assert::assertSame(10.0, $result);
});

it('casts numeric strings', function (): void {
    $result = app(SafeFloatCastAction::class)->execute('123.45');
    Assert::assertSame(123.45, $result);
});

it('casts integer strings', function (): void {
    $result = app(SafeFloatCastAction::class)->execute('123');
    Assert::assertSame(123.0, $result);
});

it('casts empty strings', function (): void {
    $result = app(SafeFloatCastAction::class)->execute('');
    Assert::assertSame(0.0, $result);
});

it('casts whitespace strings', function (): void {
    $result = app(SafeFloatCastAction::class)->execute('  123.45  ');
    Assert::assertSame(123.45, $result);
});

it('casts non-numeric strings', function (): void {
    $result = app(SafeFloatCastAction::class)->execute('abc');
    Assert::assertSame(0.0, $result);
});

it('casts non-numeric strings with default', function (): void {
    $result = app(SafeFloatCastAction::class)->execute('abc', 5.0);
    Assert::assertSame(5.0, $result);
});

it('casts boolean values', function (): void {
    $trueResult = app(SafeFloatCastAction::class)->execute(true);
    $falseResult = app(SafeFloatCastAction::class)->execute(false);

    Assert::assertSame(1.0, $trueResult);
    Assert::assertSame(0.0, $falseResult);
});

it('casts arrays', function (): void {
    $result = app(SafeFloatCastAction::class)->execute([1, 2, 3]);
    Assert::assertSame(0.0, $result);
});

it('casts objects', function (): void {
    $result = app(SafeFloatCastAction::class)->execute(new stdClass);
    Assert::assertSame(0.0, $result);
});

it('casts with range validation', function (): void {
    $normal = app(SafeFloatCastAction::class)->executeWithRange(50.0, 0.0, 100.0);
    $aboveMax = app(SafeFloatCastAction::class)->executeWithRange(150.0, 0.0, 100.0);
    $belowMin = app(SafeFloatCastAction::class)->executeWithRange(-10.0, 0.0, 100.0);

    Assert::assertSame(50.0, $normal);
    Assert::assertSame(100.0, $aboveMax);
    Assert::assertSame(0.0, $belowMin);
});

it('casts with range and default', function (): void {
    $result = app(SafeFloatCastAction::class)->executeWithRange('invalid', 0.0, 100.0, 25.0);
    Assert::assertSame(25.0, $result);
=======

beforeEach(function (): void {
    $this->action = app(SafeFloatCastAction::class);
});

it('casts float values', function (): void {
    $result = $this->action->execute(123.45);
    expect($result)->toBe(123.45)->toBeFloat();
});

it('casts integer values', function (): void {
    $result = $this->action->execute(123);
    expect($result)->toBe(123.0)->toBeFloat();
});

it('casts null values', function (): void {
    $result = $this->action->execute(null);
    expect($result)->toBe(0.0)->toBeFloat();
});

it('casts null values with custom default', function (): void {
    $result = $this->action->execute(null, 10.0);
    expect($result)->toBe(10.0)->toBeFloat();
});

it('casts numeric strings', function (): void {
    $result = $this->action->execute('123.45');
    expect($result)->toBe(123.45)->toBeFloat();
});

it('casts integer strings', function (): void {
    $result = $this->action->execute('123');
    expect($result)->toBe(123.0)->toBeFloat();
});

it('casts empty strings', function (): void {
    $result = $this->action->execute('');
    expect($result)->toBe(0.0)->toBeFloat();
});

it('casts whitespace strings', function (): void {
    $result = $this->action->execute('  123.45  ');
    expect($result)->toBe(123.45)->toBeFloat();
});

it('casts non-numeric strings', function (): void {
    $result = $this->action->execute('abc');
    expect($result)->toBe(0.0)->toBeFloat();
});

it('casts non-numeric strings with default', function (): void {
    $result = $this->action->execute('abc', 5.0);
    expect($result)->toBe(5.0)->toBeFloat();
});

it('casts boolean values', function (): void {
    $trueResult = $this->action->execute(true);
    $falseResult = $this->action->execute(false);

    expect($trueResult)->toBe(1.0)->toBeFloat()->and($falseResult)->toBe(0.0)->toBeFloat();
});

it('casts arrays', function (): void {
    $result = $this->action->execute([1, 2, 3]);
    expect($result)->toBe(0.0)->toBeFloat();
});

it('casts objects', function (): void {
    $result = $this->action->execute(new stdClass());
    expect($result)->toBe(0.0)->toBeFloat();
});

it('casts with range validation', function (): void {
    $normal = $this->action->executeWithRange(50.0, 0.0, 100.0);
    $aboveMax = $this->action->executeWithRange(150.0, 0.0, 100.0);
    $belowMin = $this->action->executeWithRange(-10.0, 0.0, 100.0);

    expect($normal)->toBe(50.0)->and($aboveMax)->toBe(100.0)->and($belowMin)->toBe(0.0);
});

it('casts with range and default', function (): void {
    $result = $this->action->executeWithRange('invalid', 0.0, 100.0, 25.0);
    expect($result)->toBe(25.0);
>>>>>>> laraxot/master
});

it('has static cast method', function (): void {
    $result = SafeFloatCastAction::cast('123.45');
<<<<<<< HEAD
    Assert::assertSame(123.45, $result);
=======
    expect($result)->toBe(123.45)->toBeFloat();
>>>>>>> laraxot/master
});

it('has static cast method with default', function (): void {
    $result = SafeFloatCastAction::cast(null, 10.0);
<<<<<<< HEAD
    Assert::assertSame(10.0, $result);
=======
    expect($result)->toBe(10.0)->toBeFloat();
>>>>>>> laraxot/master
});

it('has static castWithRange method', function (): void {
    $result = SafeFloatCastAction::castWithRange('150.0', 0.0, 100.0);
<<<<<<< HEAD
    Assert::assertSame(100.0, $result);
});

it('handles infinite values', function (): void {
    $infResult = app(SafeFloatCastAction::class)->execute('INF');
    $nanResult = app(SafeFloatCastAction::class)->execute('NAN');

    Assert::assertSame(0.0, $infResult);
    Assert::assertSame(0.0, $nanResult);
});

it('handles infinite values with default', function (): void {
    $infResult = app(SafeFloatCastAction::class)->execute('INF', 5.0);
    $nanResult = app(SafeFloatCastAction::class)->execute('NAN', 5.0);

    Assert::assertSame(5.0, $infResult);
    Assert::assertSame(5.0, $nanResult);
});

it('casts scientific notation', function (): void {
    $result1 = app(SafeFloatCastAction::class)->execute('1.23e2');
    $result2 = app(SafeFloatCastAction::class)->execute('1.23E-2');

    Assert::assertSame(123.0, $result1);
    Assert::assertSame(0.0123, $result2);
});

it('handles decimal comma', function (): void {
    $result = app(SafeFloatCastAction::class)->execute('123,45');
    Assert::assertSame(123.45, $result);
=======
    expect($result)->toBe(100.0)->toBeFloat();
});

it('handles infinite values', function (): void {
    $infResult = $this->action->execute('INF');
    $nanResult = $this->action->execute('NAN');

    expect($infResult)->toBe(0.0)->and($nanResult)->toBe(0.0);
});

it('handles infinite values with default', function (): void {
    $infResult = $this->action->execute('INF', 5.0);
    $nanResult = $this->action->execute('NAN', 5.0);

    expect($infResult)->toBe(5.0)->and($nanResult)->toBe(5.0);
});

it('casts scientific notation', function (): void {
    $result1 = $this->action->execute('1.23e2');
    $result2 = $this->action->execute('1.23E-2');

    expect($result1)->toBe(123.0)->and($result2)->toBe(0.0123);
});

it('handles decimal comma', function (): void {
    $result = $this->action->execute('123,45');
    expect($result)->toBe(123.45);
>>>>>>> laraxot/master
});
