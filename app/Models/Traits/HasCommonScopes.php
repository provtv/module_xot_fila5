<?php

declare(strict_types=1);

namespace Modules\Xot\Models\Traits;

<<<<<<< .merge_file_mFaUai
<<<<<<< HEAD
=======
>>>>>>> .merge_file_HriII2
use DateTimeInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
=======
use Illuminate\Database\Eloquent\Builder;
>>>>>>> laraxot/master

/**
 * Common query scopes for Laraxot models.
 *
 * Implements the strategy documented in METODI_DUPLICATI_ANALISI.md
 * Found 100% identical in 5 models across modules.
 *
 * Add this trait to models that need these scopes.
 *
 * Usage:
 * ```php
 * class MyModel extends BaseModel
 * {
 *     use HasCommonScopes;
 * }
 *
 * // Then use in queries:
 * MyModel::active()->get();
 * MyModel::published()->get();
 * ```
 *
 * @see docs/METODI_DUPLICATI_ANALISI.md - Proposta 4: Model Traits
 */
<<<<<<< HEAD

=======
>>>>>>> laraxot/master
trait HasCommonScopes
{
    /**
     * Scope query to only active records.
     *
     * Found 100% identical in: Activity, Blog, Cms, User, Fixcity modules.
     *
<<<<<<< .merge_file_mFaUai
<<<<<<< HEAD
     * @param  Builder<static>  $query
=======
>>>>>>> laraxot/master
=======
     * @param  Builder<static>  $query
>>>>>>> .merge_file_HriII2
     * @return Builder<static>
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope query to only inactive records.
     *
<<<<<<< .merge_file_mFaUai
<<<<<<< HEAD
     * @param  Builder<static>  $query
=======
>>>>>>> laraxot/master
=======
     * @param  Builder<static>  $query
>>>>>>> .merge_file_HriII2
     * @return Builder<static>
     */
    public function scopeInactive(Builder $query): Builder
    {
        return $query->where('is_active', false);
    }

    /**
     * Scope query to published records.
     *
     * Records with published_at <= now().
     *
<<<<<<< .merge_file_mFaUai
<<<<<<< HEAD
     * @param  Builder<static>  $query
=======
>>>>>>> laraxot/master
=======
     * @param  Builder<static>  $query
>>>>>>> .merge_file_HriII2
     * @return Builder<static>
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    /**
     * Scope query to draft (unpublished) records.
     *
     * Records with published_at = null or > now().
     *
<<<<<<< .merge_file_mFaUai
<<<<<<< HEAD
     * @param  Builder<static>  $query
=======
>>>>>>> laraxot/master
=======
     * @param  Builder<static>  $query
>>>>>>> .merge_file_HriII2
     * @return Builder<static>
     */
    public function scopeDraft(Builder $query): Builder
    {
<<<<<<< .merge_file_mFaUai
<<<<<<< HEAD
        return $query->where(static function (Builder $q): void {
=======
        return $query->where(function ($q): void {
>>>>>>> laraxot/master
=======
        return $query->where(static function (Builder $q): void {
>>>>>>> .merge_file_HriII2
            $q->whereNull('published_at')
                ->orWhere('published_at', '>', now());
        });
    }

    /**
     * Scope query to records created after a date.
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
<<<<<<< .merge_file_mFaUai
<<<<<<< HEAD
    public function scopeCreatedAfter(Builder $query, Carbon|string|DateTimeInterface $date): Builder
=======
    public function scopeCreatedAfter(Builder $query, mixed $date): Builder
>>>>>>> laraxot/master
=======
    public function scopeCreatedAfter(Builder $query, Carbon|string|DateTimeInterface $date): Builder
>>>>>>> .merge_file_HriII2
    {
        return $query->where('created_at', '>=', $date);
    }

    /**
     * Scope query to records created before a date.
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
<<<<<<< .merge_file_mFaUai
<<<<<<< HEAD
    public function scopeCreatedBefore(Builder $query, Carbon|string|DateTimeInterface $date): Builder
=======
    public function scopeCreatedBefore(Builder $query, mixed $date): Builder
>>>>>>> laraxot/master
=======
    public function scopeCreatedBefore(Builder $query, Carbon|string|DateTimeInterface $date): Builder
>>>>>>> .merge_file_HriII2
    {
        return $query->where('created_at', '<=', $date);
    }

    /**
     * Scope query to records updated after a date.
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
<<<<<<< .merge_file_mFaUai
<<<<<<< HEAD
    public function scopeUpdatedAfter(Builder $query, Carbon|string|DateTimeInterface $date): Builder
=======
    public function scopeUpdatedAfter(Builder $query, mixed $date): Builder
>>>>>>> laraxot/master
=======
    public function scopeUpdatedAfter(Builder $query, Carbon|string|DateTimeInterface $date): Builder
>>>>>>> .merge_file_HriII2
    {
        return $query->where('updated_at', '>=', $date);
    }

    /**
     * Scope query to records created by a specific user.
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    public function scopeCreatedBy(Builder $query, string|int $userId): Builder
    {
        return $query->where('created_by', $userId);
    }

    /**
     * Check if the model is published.
     */
    public function isPublished(): bool
    {
<<<<<<< HEAD
        $publishedAt = $this->getAttribute('published_at');

        if (! $publishedAt instanceof Carbon) {
            return false;
        }

        return $publishedAt->isPast();
=======
        if (! isset($this->published_at)) {
            return false;
        }

        return $this->published_at !== null &&
               $this->published_at->isPast();
>>>>>>> laraxot/master
    }

    /**
     * Check if the model is draft.
     */
    public function isDraft(): bool
    {
        return ! $this->isPublished();
    }

    /**
     * Check if the model is active.
     */
    public function isActive(): bool
    {
<<<<<<< .merge_file_mFaUai
<<<<<<< HEAD
        return $this->getAttribute('is_active') === true;
=======
        return isset($this->is_active) && $this->is_active === true;
>>>>>>> laraxot/master
=======
        return $this->getAttribute('is_active') === true;
>>>>>>> .merge_file_HriII2
    }
}
