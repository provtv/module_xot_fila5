<?php

declare(strict_types=1);

namespace Modules\Xot\Models;

<<<<<<< HEAD
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Modules\Tenant\Models\Traits\SushiToJson;
use Modules\Xot\Contracts\ProfileContract;
use Modules\Xot\Database\Factories\InformationSchemaTableFactory;

/**
 * @property int|null             $table_rows
 * @property string               $table_schema
 * @property string               $table_name
 * @property string|null          $model_class
 * @property Carbon|null          $created_at
 * @property string|null          $created_by
 * @property int                  $id
 * @property Carbon|null          $updated_at
 * @property string|null          $updated_by
 * @property ProfileContract|null $creator
 * @property ProfileContract|null $deleter
 * @property ProfileContract|null $updater
 * @method static InformationSchemaTableFactory          factory($count = null, $state = [])
 * @method static Builder<static>|InformationSchemaTable newModelQuery()
 * @method static Builder<static>|InformationSchemaTable newQuery()
 * @method static Builder<static>|InformationSchemaTable query()
 * @method static Builder<static>|InformationSchemaTable whereCreatedAt($value)
 * @method static Builder<static>|InformationSchemaTable whereCreatedBy($value)
 * @method static Builder<static>|InformationSchemaTable whereId($value)
 * @method static Builder<static>|InformationSchemaTable whereModelClass($value)
=======
use InvalidArgumentException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;
use Modules\Tenant\Models\Traits\SushiToJson;
use Sushi\Sushi;

/**
 * Represents a table in the INFORMATION_SCHEMA.TABLES.
 *
 * Provides metadata and statistics about database tables.
 *
 * @property string|null $TABLE_CATALOG
 * @property string|null $TABLE_SCHEMA
 * @property string|null $TABLE_NAME
 * @property string|null $TABLE_TYPE
 * @property string|null $ENGINE
 * @property int|null    $VERSION
 * @property string|null $ROW_FORMAT
 * @property int|null    $table_rows
 * @property int|null    $AVG_ROW_LENGTH
 * @property int|null    $DATA_LENGTH
 * @property int|null    $MAX_DATA_LENGTH
 * @property int|null    $INDEX_LENGTH
 * @property int|null    $DATA_FREE
 * @property int|null    $AUTO_INCREMENT
 * @property Carbon|null $CREATE_TIME
 * @property Carbon|null $UPDATE_TIME
 * @property Carbon|null $CHECK_TIME
 * @property string|null $TABLE_COLLATION
 * @property int|null    $CHECKSUM
 * @property string|null $CREATE_OPTIONS
 * @property string|null $TABLE_COMMENT
 * @property int         $id
 *
 * @method static Builder<static>|InformationSchemaTable newModelQuery()
 * @method static Builder<static>|InformationSchemaTable newQuery()
 * @method static Builder<static>|InformationSchemaTable query()
 * @method static Builder<static>|InformationSchemaTable whereAUTOINCREMENT($value)
 * @method static Builder<static>|InformationSchemaTable whereAVGROWLENGTH($value)
 * @method static Builder<static>|InformationSchemaTable whereCHECKSUM($value)
 * @method static Builder<static>|InformationSchemaTable whereCHECKTIME($value)
 * @method static Builder<static>|InformationSchemaTable whereCREATEOPTIONS($value)
 * @method static Builder<static>|InformationSchemaTable whereCREATETIME($value)
 * @method static Builder<static>|InformationSchemaTable whereDATAFREE($value)
 * @method static Builder<static>|InformationSchemaTable whereDATALENGTH($value)
 * @method static Builder<static>|InformationSchemaTable whereENGINE($value)
 * @method static Builder<static>|InformationSchemaTable whereINDEXLENGTH($value)
 * @method static Builder<static>|InformationSchemaTable whereId($value)
 * @method static Builder<static>|InformationSchemaTable whereMAXDATALENGTH($value)
 * @method static Builder<static>|InformationSchemaTable whereROWFORMAT($value)
 * @method static Builder<static>|InformationSchemaTable whereTABLECATALOG($value)
 * @method static Builder<static>|InformationSchemaTable whereTABLECOLLATION($value)
 * @method static Builder<static>|InformationSchemaTable whereTABLECOMMENT($value)
 * @method static Builder<static>|InformationSchemaTable whereTABLENAME($value)
 * @method static Builder<static>|InformationSchemaTable whereTABLEROWS($value)
 * @method static Builder<static>|InformationSchemaTable whereTABLESCHEMA($value)
 * @method static Builder<static>|InformationSchemaTable whereTABLETYPE($value)
 * @method static Builder<static>|InformationSchemaTable whereUPDATETIME($value)
 * @method static Builder<static>|InformationSchemaTable whereVERSION($value)
 *
 * @property string|null $table_schema
 * @property string|null $table_name
 * @property string|null $updated_at
 * @property string|null $updated_by
 * @property string|null $created_at
 * @property string|null $created_by
 *
 * @method static Builder<static>|InformationSchemaTable whereCreatedAt($value)
 * @method static Builder<static>|InformationSchemaTable whereCreatedBy($value)
>>>>>>> laraxot/master
 * @method static Builder<static>|InformationSchemaTable whereTableName($value)
 * @method static Builder<static>|InformationSchemaTable whereTableRows($value)
 * @method static Builder<static>|InformationSchemaTable whereTableSchema($value)
 * @method static Builder<static>|InformationSchemaTable whereUpdatedAt($value)
 * @method static Builder<static>|InformationSchemaTable whereUpdatedBy($value)
<<<<<<< .merge_file_3olG4W
<<<<<<< HEAD
=======
>>>>>>> .merge_file_ZDijzg
 * @mixin \Eloquent
 */
class InformationSchemaTable extends BaseModel
=======
 *
 * @mixin \Eloquent
 */
class InformationSchemaTable extends Model
>>>>>>> laraxot/master
{
    use SushiToJson;

    /**
<<<<<<< HEAD
=======
     * The attributes that are mass assignable.
     *
>>>>>>> laraxot/master
     * @var list<string>
     */
    protected $fillable = [
        'table_schema',
        'table_name',
        'table_rows',
        'model_class',
        'updated_at',
        'updated_by',
        'created_at',
        'created_by',
    ];

    /**
<<<<<<< HEAD
     * Schema utilizzato dal trait Sushi per tipizzare i campi.
     *
     * @var array<string, string>
     */
    protected array $schema = [
=======
     * The schema for the Sushi model.
     *
     * @var array<string, string>
     */
    protected $form = [
>>>>>>> laraxot/master
        'id' => 'integer',
        'table_schema' => 'string',
        'table_name' => 'string',
        'table_rows' => 'integer',
        'model_class' => 'string',
        'updated_at' => 'datetime',
        'updated_by' => 'string',
        'created_at' => 'datetime',
        'created_by' => 'string',
    ];

    /**
<<<<<<< HEAD
     * Restituisce lo schema atteso da Sushi.
=======
     * Alias compatibile per trait SushiToJson che attende getSchema().
>>>>>>> laraxot/master
     *
     * @return array<string, string>
     */
    public function getSchema(): array
    {
<<<<<<< HEAD
        return $this->schema;
    }

    /**
     * Restituisce i record da utilizzare per popolare la tabella in-memory.
=======
        return $this->form;
    }

    /**
     * Get the rows array for the Sushi model.
     * This method is required by Sushi to provide the data.
>>>>>>> laraxot/master
     *
     * @return array<int, array<string, mixed>>
     */
    public function getRows(): array
    {
<<<<<<< HEAD
        /** @var array<int, array<string, mixed>> $rows */
        $rows = $this->getSushiRows();

        return $rows;
    }

    /**
     * Aggiorna il numero di record memorizzato per un modello.
     *
     * @param class-string<Model> $modelClass
     */
    public static function updateModelCount(string $modelClass, int $total): void
    {
        if (! class_exists($modelClass)) {
            throw new \InvalidArgumentException("Model class [{$modelClass}] does not exist");
=======
        return $this->getSushiRows();
    }

    public static function updateModelCount(string $modelClass, int $total): void
    {
        if (! class_exists($modelClass)) {
            throw new InvalidArgumentException("Model class [{$modelClass}] does not exist");
>>>>>>> laraxot/master
        }

        /** @var Model $model */
        $model = app($modelClass);
<<<<<<< HEAD
        if (! $model instanceof Model) {
            throw new \InvalidArgumentException("Class [{$modelClass}] must be an instance of ".Model::class);
=======

        if (! ($model instanceof Model)) {
            throw new InvalidArgumentException("Class [{$modelClass}] must be an instance of ".Model::class);
>>>>>>> laraxot/master
        }

        $connection = $model->getConnection();
        $database = $connection->getDatabaseName();
<<<<<<< HEAD
        $table = $model->getTable();

        static::updateOrCreate([
            'table_schema' => $database,
            'model_class' => $modelClass,
            'table_name' => $table,
        ], [
            'table_rows' => $total,
        ]);
    }

    /**
     * Restituisce il numero di record per un modello.
     *
     * @param class-string<Model> $modelClass
=======
        $driver = $connection->getDriverName();
        $table = $model->getTable();
        $where = ['table_schema' => $database, 'model_class' => $modelClass, 'table_name' => $table];
        $row = InformationSchemaTable::updateOrCreate($where, ['table_rows' => $total]);
    }

    /**
     * Get the row count for a model class.
     * This method incorporates the logic from CountAction.
     *
     * @param class-string<Model> $modelClass The fully qualified model class name
     *
     * @throws InvalidArgumentException If model class is invalid or not found
>>>>>>> laraxot/master
     */
    public static function getModelCount(string $modelClass): int
    {
        if (! class_exists($modelClass)) {
<<<<<<< HEAD
            throw new \InvalidArgumentException("Model class [{$modelClass}] does not exist");
=======
            throw new InvalidArgumentException("Model class [{$modelClass}] does not exist");
>>>>>>> laraxot/master
        }

        /** @var Model $model */
        $model = app($modelClass);
<<<<<<< HEAD
        if (! $model instanceof Model) {
            throw new \InvalidArgumentException("Class [{$modelClass}] must be an instance of ".Model::class);
=======

        if (! ($model instanceof Model)) {
            throw new InvalidArgumentException("Class [{$modelClass}] must be an instance of ".Model::class);
>>>>>>> laraxot/master
        }

        $connection = $model->getConnection();
        $database = $connection->getDatabaseName();
<<<<<<< HEAD
        $table = $model->getTable();

        $record = static::firstOrCreate([
            'table_schema' => $database,
            'model_class' => $modelClass,
            'table_name' => $table,
        ]);

        if (null === $record->table_rows) {
            $record->update(['table_rows' => $model->count()]);
        }

        return (int) $record->table_rows;
=======
        $driver = $connection->getDriverName();
        $table = $model->getTable();

        $where = ['table_schema' => $database, 'model_class' => $modelClass, 'table_name' => $table];
        $row = InformationSchemaTable::firstOrCreate($where);
        if (null === $row->table_rows) {
            $table_rows = $model->count();
            $row = tap($row)->update(['table_rows' => $table_rows]);
        }

        return intval($row->table_rows);

        /*
         * // Handle in-memory database
         * if (':memory:' === $database) {
         * return (int) $model->count();
         * }
         *
         * // Handle SQLite specifically
         * if ('sqlite' === $driver) {
         * return (int) $model->count();
         * }
         *
         * return $model->count();
         *
         * return static::getAccurateRowCount($table, $database);
         */
>>>>>>> laraxot/master
    }
}
