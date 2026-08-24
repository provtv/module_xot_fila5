<?php

declare(strict_types=1);

namespace Modules\Xot\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Modules\Xot\ValueObjects\PhoneValueObject;

/**
 * @implements CastsAttributes<PhoneValueObject, PhoneValueObject>
 */
class PhoneCast implements CastsAttributes
{
    /**
     * Cast the given value.
     *
<<<<<<< .merge_file_jPDkyq
     * @param  string  $_key  The attribute key
     * @param  array<string, mixed>  $_attributes  All model attributes
=======
     * @param string               $_key        The attribute key
     * @param array<string, mixed> $_attributes All model attributes
>>>>>>> .merge_file_PVbIRK
     */
    public function get(mixed $_model, string $_key, mixed $value, array $_attributes): PhoneValueObject
    {
        if (! is_string($value)) {
            throw new \Exception('['.__LINE__.']['.class_basename($this).']');
        }

        return PhoneValueObject::fromString($value);
    }

    /**
     * Prepare the given value for storage.
     *
<<<<<<< .merge_file_jPDkyq
     * @param  string  $_key  The attribute key
     * @param  array<string, mixed>  $_attributes  All model attributes
=======
     * @param string               $_key        The attribute key
     * @param array<string, mixed> $_attributes All model attributes
>>>>>>> .merge_file_PVbIRK
     */
    public function set(mixed $_model, string $_key, mixed $value, array $_attributes): string
    {
        if (! $value instanceof PhoneValueObject) {
            throw new \InvalidArgumentException('The given value is not an Phone instance.');
        }

        return $value->toString();
    }
}
