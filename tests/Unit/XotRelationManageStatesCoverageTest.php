<?php

declare(strict_types=1);

namespace Modules\Xot\Tests\Unit;

use Illuminate\Database\Eloquent\Relations\MorphPivot;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Modules\Xot\Filament\Resources\XotBaseResource\Pages\XotBaseManageRelatedRecords;
use Modules\Xot\Models\Cache as CacheModel;
use Modules\Xot\Tests\TestCase;
use PHPUnit\Framework\Assert;

uses(TestCase::class)->group('no-xot-db');

final class XotCovPivot extends Pivot
{
    protected $table = 'cache_cache';

    public $incrementing = true;

    protected $fillable = ['cache_id', 'related_id', 'extra'];
}

final class XotCovMorphPivot extends MorphPivot
{
    protected $table = 'cache_morph';

    protected $fillable = ['cache_id', 'related_id', 'related_type'];
}

final class XotCovRelationHost extends CacheModel
{
    public $timestamps = false;

    public function guessPivot(string $related, ?string $class = null): Pivot
    {
        return new XotCovPivot;
    }

    public function guessMorphPivot(string $related, ?string $_class = null): MorphPivot
    {
        return new XotCovMorphPivot;
    }
}

/** @extends XotBaseManageRelatedRecords<CacheModel> */
final class XotCovManageRelated extends XotBaseManageRelatedRecords
{
    protected static string $resource = \Modules\Xot\Filament\Resources\XotBaseResource::class;

    protected static string $relationship = 'sessions';
}

describe('Xot RelationX ManageRelated StatesChart', function (): void {
    test('RelationX belongsToManyX morphToManyX con pivot stub', function (): void {
        config([
            'database.default' => 'sqlite',
            'database.connections.sqlite' => [
                'driver' => 'sqlite',
                'database' => ':memory:',
                'prefix' => '',
                'foreign_key_constraints' => false,
            ],
        ]);
        DB::purge('sqlite');
        DB::reconnect('sqlite');
        Schema::dropIfExists('cache');
        Schema::create('cache', static function (Blueprint $t): void {
            $t->increments('id');
            $t->string('key')->nullable();
            $t->text('value')->nullable();
        });
        Schema::dropIfExists('cache_cache');
        Schema::create('cache_cache', static function (Blueprint $t): void {
            $t->increments('id');
            $t->unsignedBigInteger('cache_id')->nullable();
            $t->unsignedBigInteger('related_id')->nullable();
            $t->string('extra')->nullable();
            $t->timestamps();
        });
        Schema::dropIfExists('cache_morph');
        Schema::create('cache_morph', static function (Blueprint $t): void {
            $t->increments('id');
            $t->unsignedBigInteger('cache_id')->nullable();
            $t->unsignedBigInteger('related_id')->nullable();
            $t->string('related_type')->nullable();
            $t->timestamps();
        });

        $host = new XotCovRelationHost;
        $host->forceFill(['id' => 1, 'key' => 'k', 'value' => 'v']);
        $host->exists = true;

        $relation = $host->belongsToManyX(CacheModel::class);
        Assert::assertSame('cache_cache', $relation->getTable());
        Assert::assertSame(
            ['cache_id', 'related_id', 'extra', 'created_at', 'updated_at'],
            $relation->getPivotColumns(),
        );

        $morphRelation = $host->morphToManyX(CacheModel::class, 'taggable');
        Assert::assertSame('cache_morph', $morphRelation->getTable());
        Assert::assertSame(
            ['cache_id', 'related_id', 'related_type', 'created_at', 'updated_at'],
            $morphRelation->getPivotColumns(),
        );
    });

    test('ManageRelatedRecords exposes its stable navigation contract', function (): void {
        Assert::assertSame('', XotCovManageRelated::getNavigationGroup());
    });
});
