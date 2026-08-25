<?php

declare(strict_types=1);

namespace Modules\Xot\Tests\Unit;

use Illuminate\Database\Eloquent\Model;
use Modules\Xot\Actions\Mail\SendMailByRecordAction;
use Modules\Xot\Tests\TestCase;

uses(TestCase::class);

it('throws if record has no email', function (): void {
    $record = new class extends Model {
        public function option(string $key): null
        {
            return null;
        }

<<<<<<< HEAD
       public function myLogs(): object
=======
        public function myLogs(): object
>>>>>>> laraxot/dev
        {
            return new class {
                /** @param array<mixed> $data */
                public function create(array $data): void
                {
                }
            };
        }
    };

<<<<<<< HEAD
   $this->expectThrowable(\InvalidArgumentException::class);
=======
    $this->expectThrowable(\InvalidArgumentException::class);
>>>>>>> laraxot/dev

    app(SendMailByRecordAction::class)->execute($record, \stdClass::class);
});
