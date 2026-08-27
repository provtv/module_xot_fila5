<?php

declare(strict_types=1);

namespace Modules\Xot\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Xot\Contracts\ProfileContract;
use Modules\Xot\Datas\XotData;
use Webmozart\Assert\Assert;

/**
 * Trait Updater.
 * https://dev.to/hasanmn/automatically-update-createdby-and-updatedby-in-laravel-using-bootable-traits-28g9.
 *
<<<<<<< HEAD
 * @property int|null             $created_by ID dell'utente che ha creato il record
 * @property int|null             $updated_by ID dell'utente che ha aggiornato il record
 * @property int|null             $deleted_by ID dell'utente che ha eliminato il record
 * @property ProfileContract|null $creator
 * @property ProfileContract|null $updater
 * @property ProfileContract|null $deleter
=======
 * @property int|null $created_by ID dell'utente che ha creato il record
 * @property int|null $updated_by ID dell'utente che ha aggiornato il record
 * @property int|null $deleted_by ID dell'utente che ha eliminato il record
 * @property-read ProfileContract|null $creator
 * @property-read ProfileContract|null $updater
 * @property-read ProfileContract|null $deleter
>>>>>>> laraxot/master
 */
trait Updater
{
    /**
<<<<<<< HEAD
     * Get the user who created the model.
     *
     * @return BelongsTo<Model&ProfileContract, $this>
     *
     * @phpstan-return BelongsTo<Model&ProfileContract, $this>
=======
     * Summary of creator.
     *
     * @return BelongsTo<ProfileContract&Model, static>
>>>>>>> laraxot/master
     */
    public function creator(): BelongsTo
    {
        /** @var class-string<ProfileContract&Model> $profileClass */
        $profileClass = XotData::make()->getProfileClass();

<<<<<<< HEAD
=======
        // @phpstan-ignore return.type
>>>>>>> laraxot/master
        return $this->belongsTo($profileClass, 'created_by', 'user_id');
    }

    /**
     * Get the last user who updated the model.
     *
<<<<<<< HEAD
     * @return BelongsTo<Model&ProfileContract, $this>
     *
     * @phpstan-return BelongsTo<Model&ProfileContract, $this>
=======
     * @return BelongsTo<ProfileContract&Model, static>
>>>>>>> laraxot/master
     */
    public function updater(): BelongsTo
    {
        /** @var class-string<ProfileContract&Model> $profileClass */
        $profileClass = XotData::make()->getProfileClass();

<<<<<<< HEAD
=======
        // @phpstan-ignore return.type
>>>>>>> laraxot/master
        return $this->belongsTo($profileClass, 'updated_by', 'user_id');
    }

    /**
<<<<<<< HEAD
     * Get the user who deleted the model.
     *
     * @return BelongsTo<Model&ProfileContract, $this>
     *
     * @phpstan-return BelongsTo<Model&ProfileContract, $this>
     */
    public function deleter(): BelongsTo
    {
        /** @var class-string<ProfileContract&Model> $profileClass */
        $profileClass = XotData::make()->getProfileClass();

        return $this->belongsTo($profileClass, 'deleted_by', 'user_id');
    }

    /**
=======
>>>>>>> laraxot/master
     * bootUpdater function.
     */
    protected static function bootUpdater(): void
    {
        static::creating(static function (Model $model): void {
            Assert::isArray($attributes = $model->getAttributes());

            if (array_key_exists('created_by', $attributes)) {
                $model->setAttribute('created_by', authId());
            }

            if (array_key_exists('updated_by', $attributes)) {
                $model->setAttribute('updated_by', authId());
            }
        });

        static::updating(static function (Model $model): void {
            Assert::isArray($attributes = $model->getAttributes());

            if (array_key_exists('updated_by', $attributes)) {
                $model->setAttribute('updated_by', authId());
            }
        });
        /*
         * Deleting a model is slightly different than creating or deleting.
         * For deletes we need to save the model first with the deleted_by field
         */
        static::deleting(static function (Model $model): void {
<<<<<<< HEAD
            Assert::isArray($attributes = $model->getAttributes());
=======
            Assert::isArray($attributes = $model->attributes);
>>>>>>> laraxot/master

            if (\in_array('deleted_by', array_keys($attributes), false)) {
                $model->setAttribute('deleted_by', authId());
            }
        });
    }
}

// end trait Updater
