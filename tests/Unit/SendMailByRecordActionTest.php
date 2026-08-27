<?php

declare(strict_types=1);

<<<<<<< HEAD
namespace Modules\Xot\Tests\Unit;

use Illuminate\Database\Eloquent\Model;
use Modules\Xot\Actions\Mail\SendMailByRecordAction;
use Modules\Xot\Tests\TestCase;

uses(TestCase::class)->group('no-xot-db');

it('throws if record has no email', function (): void {
    $record = new class extends Model {
        public function option(string $key): null
=======
use Illuminate\Mail\Mailable;
use Illuminate\Database\Eloquent\Model;
use Modules\Xot\Actions\Mail\SendMailByRecordAction;

it('throws if record has no email', function (): void {
    $record = new class extends Model {
        // no email attribute
        public function option(string $key): null|string
>>>>>>> laraxot/master
        {
            return null;
        }

<<<<<<< HEAD
        public function myLogs(): object
        {
            return new class {
                /** @param array<mixed> $data */
=======
        public function myLogs()
        {
            return new class {
>>>>>>> laraxot/master
                public function create(array $data): void
                {
                }
            };
        }
    };

<<<<<<< HEAD
    $this->expectThrowable(\InvalidArgumentException::class);

    app(SendMailByRecordAction::class)->execute($record, \stdClass::class);
=======
    expect(fn() => app(SendMailByRecordAction::class)->execute($record, Mailable::class))
        ->toThrow(InvalidArgumentException::class);
>>>>>>> laraxot/master
});
