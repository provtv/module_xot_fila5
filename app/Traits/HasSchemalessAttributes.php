<?php

declare(strict_types=1);

namespace Modules\Xot\Traits;

use Illuminate\Database\Eloquent\Builder;
<<<<<<< HEAD

use function Safe\json_encode;

=======
>>>>>>> laraxot/master
use Spatie\SchemalessAttributes\SchemalessAttributes;

/**
 * Trait per implementare Schemaless Attributes in modo consistente.
 *
 * Fornisce metodi standard per lavorare con extra_attributes
 * seguendo le best practices di Spatie.
 *
<<<<<<< HEAD
 * @property SchemalessAttributes|null $extra_attributes
 *
 * @see https://github.com/spatie/laravel-schemaless-attributes
 *
=======
 * @see https://github.com/spatie/laravel-schemaless-attributes
>>>>>>> laraxot/master
 */
trait HasSchemalessAttributes
{
    /**
     * Aggiunge extra_attributes al fillable.
     *
     * @return array<string>
     */
    protected function schemalessFillable(): array
    {
        return array_merge($this->fillable, [
            'extra_attributes',
        ]);
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function schemalessCasts(): array
    {
<<<<<<< HEAD
        /** @var array<string, string> $casts */
        $casts = $this->casts;

        return array_merge($casts, [
=======
        return array_merge($this->casts ?? [], [
>>>>>>> laraxot/master
            'extra_attributes' => SchemalessAttributes::class,
        ]);
    }

    /**
     * Scope per filtrare per attributi schemaless.
<<<<<<< HEAD
     *
     * @param Builder<static> $query
     *
     * @return Builder<static>
     */
    public function scopeWithExtraAttributes(Builder $query): Builder
    {
        if ($this->extra_attributes instanceof SchemalessAttributes) {
=======
     */
    public function scopeWithExtraAttributes(Builder $query): Builder
    {
        if (isset($this->extra_attributes) && is_object($this->extra_attributes)) {
>>>>>>> laraxot/master
            return $this->extra_attributes->modelScope();
        }

        return $query;
    }

    /**
     * Scope per query specifiche su extra_attributes.
<<<<<<< HEAD
     *
     * @param Builder<static> $query
     *
     * @return Builder<static>
=======
>>>>>>> laraxot/master
     */
    public function scopeWhereExtraAttribute(Builder $query, string $key, mixed $value): Builder
    {
        return $query->where("extra_attributes->{$key}", $value);
    }

    /**
<<<<<<< HEAD
     * Spatie persiste extra_attributes come array sul modello dopo set/forget.
     * Re-idratare sempre il wrapper prima di leggere o scrivere.
     */
    protected function extraAttributesWrapper(): SchemalessAttributes
    {
        if ($this->extra_attributes instanceof SchemalessAttributes) {
            return $this->extra_attributes;
        }

        $raw = $this->attributes['extra_attributes'] ?? null;
        if (is_array($raw)) {
            $this->attributes['extra_attributes'] = json_encode($raw);
        }

        $wrapper = SchemalessAttributes::createForModel($this, 'extra_attributes');
        $this->extra_attributes = $wrapper;

        return $wrapper;
    }

    /**
=======
>>>>>>> laraxot/master
     * Get un valore da extra_attributes.
     */
    public function getExtraAttribute(string $key, mixed $default = null): mixed
    {
<<<<<<< HEAD
        return $this->extraAttributesWrapper()->get($key, $default);
=======
        return $this->extra_attributes?->get($key, $default) ?? $default;
>>>>>>> laraxot/master
    }

    /**
     * Set un valore in extra_attributes.
     */
    public function setExtraAttribute(string $key, mixed $value): void
    {
<<<<<<< HEAD
        $this->extraAttributesWrapper()->set($key, $value);
        $this->syncExtraAttributesWrapper();
=======
        if (! $this->extra_attributes) {
            $this->extra_attributes = new SchemalessAttributes;
        }

        $this->extra_attributes->set($key, $value);
>>>>>>> laraxot/master
    }

    /**
     * Get tutti gli extra_attributes come array.
     *
     * @return array<string, mixed>
     */
    public function getExtraAttributes(): array
    {
<<<<<<< HEAD
        $raw = $this->extraAttributesWrapper()->all();
        $result = [];

        foreach ($raw as $key => $value) {
            if (is_string($key)) {
                $result[$key] = $value;
            }
        }

        return $result;
=======
        return $this->extra_attributes?->all() ?? [];
>>>>>>> laraxot/master
    }

    /**
     * Controlla se esiste un attributo in extra_attributes.
     */
    public function hasExtraAttribute(string $key): bool
    {
<<<<<<< HEAD
        return $this->extraAttributesWrapper()->has($key);
=======
        return $this->extra_attributes?->has($key) ?? false;
>>>>>>> laraxot/master
    }

    /**
     * Rimuove un attributo da extra_attributes.
     */
    public function removeExtraAttribute(string $key): void
    {
<<<<<<< HEAD
        $this->extraAttributesWrapper()->forget($key);
        $this->syncExtraAttributesWrapper();
    }

    protected function syncExtraAttributesWrapper(): void
    {
        $raw = $this->attributes['extra_attributes'] ?? null;
        if (is_array($raw)) {
            $this->attributes['extra_attributes'] = json_encode($raw);
        }

        $this->extra_attributes = SchemalessAttributes::createForModel($this, 'extra_attributes');
=======
        $this->extra_attributes->forget($key);
>>>>>>> laraxot/master
    }

    /**
     * Sincronizza gli extra_attributes con il database.
     */
    public function syncExtraAttributes(): void
    {
        $this->save();
    }
}
