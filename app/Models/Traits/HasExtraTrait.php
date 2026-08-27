<?php

declare(strict_types=1);

namespace Modules\Xot\Models\Traits;

<<<<<<< HEAD
=======
use Exception;
>>>>>>> laraxot/master
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Str;
use Modules\Xot\Contracts\ExtraContract;
<<<<<<< HEAD

use function Safe\json_encode;

use Spatie\SchemalessAttributes\SchemalessAttributes;
use Webmozart\Assert\Assert;

/**
 * Modules\Xot\Models\HasExtraTrait.
 *
 * @property string             $currency
 * @property float              $price
 * @property string             $price_complete
 * @property int                $qty
 * @property ExtraContract|null $extra
 */

=======
use Modules\Xot\Models\Extra;
use Webmozart\Assert\Assert;

use function Safe\json_encode;

/**
 * Modules\Xot\Models\HasExtraTrait.
 *
 * @property string $currency
 * @property float $price
 * @property string $price_complete
 * @property int $qty
 * @property ExtraContract|null $extra
 */
>>>>>>> laraxot/master
trait HasExtraTrait
{
    /**
     * Retrieves the morphed one-to-one relationship between the current model and the Extra model.
     *
<<<<<<< .merge_file_v6HWq1
<<<<<<< HEAD
     * @return MorphOne<Model, $this>
=======
     * return MorphOne<ExtraContract>
>>>>>>> laraxot/master
=======
     * @return MorphOne<Model, $this>
>>>>>>> .merge_file_RWZN4J
     */
    public function extra(): MorphOne
    {
        $extra_class = Str::of(static::class)
            ->before('\Models\\')
            ->append('\Models\Extra')
            ->toString();
        Assert::classExists($extra_class);
        Assert::isAOf(
            $extra_class,
            Model::class,
<<<<<<< HEAD
            '['.__LINE__.']['.class_basename($this).']['.$extra_class.']',
        );

        /** @var class-string<Model> $extraClass */
        $extraClass = $extra_class;

        return $this->morphOne($extraClass, 'model');
    }

    /** @return array<string, mixed>|bool|float|int|string|null */
    public function getExtra(string $name): array|bool|float|int|string|null
    {
        $extra = $this->extra;
        if (! $extra instanceof ExtraContract || ! $extra instanceof Model) {
            return null;
        }

        $attributes = $extra->extra_attributes;
        if (! $attributes instanceof SchemalessAttributes) {
            return null;
        }

        $value = $attributes->get($name);

        if (\is_array($value)) {
            $result = [];
            foreach ($value as $key => $item) {
                if (! \is_string($key)) {
                    continue;
                }

                $result[$key] = $item;
            }

            return $result;
        }

        if (\is_bool($value) || \is_float($value) || \is_int($value) || \is_string($value)) {
            return $value;
        }

        return null;
    }

    /**
     * @param int|float|string|array<string, mixed>|bool|null $value
     */
    public function setExtra(string $name, int|float|string|array|bool|null $value): void
    {
        $extra = $this->extra;
        if (! $extra instanceof ExtraContract || ! $extra instanceof Model) {
            $extra = $this->extra()->firstOrCreate([], ['extra_attributes' => json_encode([])]);
            if (! $extra instanceof ExtraContract || ! $extra instanceof Model) {
                return;
            }
        }

        $attributes = $extra->extra_attributes;
        if (! $attributes instanceof SchemalessAttributes) {
            $extra->extra_attributes = $attributes = new SchemalessAttributes($extra, 'extra_attributes');
        }

        $attributes->set($name, $value);
=======
            '[' . __LINE__ . '][' . class_basename($this) . '][' . $extra_class . ']',
        );
        // Assert::isInstanceOf($extra_class, ExtraContract::class, '['.__LINE__.']['.class_basename($this).']['.$extra_class.']');
        // Assert::implementsInterface($extra_class, ExtraContract::class, '['.__LINE__.']['.class_basename($this).']['.$extra_class.']');

        return $this->morphOne($extra_class, 'model');
    }

    /**
     * @return array<string, mixed>|bool|int|string|null
     */
    public function getExtra(string $name): array|bool|int|string|null
    {
        if ($this->extra === null) {
            return null;
        }
        $value = $this->extra->extra_attributes->get($name);
        if (
            is_array($value) ||
                is_int($value) ||
                // || is_float($value)
                is_null($value) ||
                is_bool($value) ||
                is_string($value)
        ) {
            /** @var array<string, mixed>|bool|int|string|null */
            return $value;
        }
        throw new Exception('[' . __LINE__ . '][' . __CLASS__ . ']');
    }

    /**
     * @param  int|float|string|array<string, mixed>|bool|null  $value
     * @return void
     */
    public function setExtra(string $name, $value)
    {
        $extra = $this->extra;
        if ($this->extra === null) {
            // $extra = $this->extra()->firstOrCreate([], ['extra_attributes' => []]);
            $extra = $this->extra()->firstOrCreate([], ['extra_attributes' => json_encode([])]);
            Assert::implementsInterface(
                $extra,
                ExtraContract::class,
                '[' . __LINE__ . '][' . class_basename($this) . '][' . $extra . ']',
            );
        }
        Assert::notNull($extra);
        // $extra is asserted to be non-null above
        $extra->extra_attributes->set($name, $value);
>>>>>>> laraxot/master
        $extra->save();
    }
}
