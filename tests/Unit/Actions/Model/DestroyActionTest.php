<?php

declare(strict_types=1);

namespace Modules\Xot\Tests\Unit\Actions\Model;

use Illuminate\Support\Facades\Session;
use Modules\Xot\Actions\Model\DestroyAction;
use Modules\Xot\Models\BaseModel;
use Modules\Xot\Tests\TestCase;
use PHPUnit\Framework\Assert;

uses(TestCase::class);

it('deletes model and returns it', function (): void {
    $mockModel = new class extends BaseModel {
        public bool $deleted = false;

        public function delete(): bool
        {
<<<<<<< HEAD
           $this->deleted = true;
=======
            $this->deleted = true;
>>>>>>> laraxot/dev

            return true;
        }
    };

<<<<<<< HEAD
   $result = app(DestroyAction::class)->execute($mockModel, [], []);
=======
    $result = app(DestroyAction::class)->execute($mockModel, [], []);
>>>>>>> laraxot/dev

    Assert::assertSame($mockModel, $result);
    Assert::assertTrue($mockModel->deleted);
});

it('flashes status message on successful delete', function (): void {
    $mockModel = new class extends BaseModel {
        public function delete(): bool
        {
            return true;
        }
    };

<<<<<<< HEAD
   app(DestroyAction::class)->execute($mockModel, [], []);
=======
    app(DestroyAction::class)->execute($mockModel, [], []);
>>>>>>> laraxot/dev

    Assert::assertSame('eliminato', Session::get('status'));
});

it('flashes failure message when delete returns false', function (): void {
    $mockModel = new class extends BaseModel {
        public function delete(): bool
        {
            return false;
        }
    };

<<<<<<< HEAD
   app(DestroyAction::class)->execute($mockModel, [], []);
=======
    app(DestroyAction::class)->execute($mockModel, [], []);
>>>>>>> laraxot/dev

    Assert::assertSame('NON eliminato', Session::get('status'));
});
