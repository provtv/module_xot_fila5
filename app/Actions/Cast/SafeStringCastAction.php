<?php

declare(strict_types=1);

namespace Modules\Xot\Actions\Cast;

/**
 * Action per convertire in modo sicuro un valore mixed in string.
 *
 * Questa action centralizza la logica di cast sicuro per evitare duplicazioni
 * di codice (principio DRY) e garantire comportamento consistente in tutto il codebase.
 */
class SafeStringCastAction
{
    /**
     * Converte in modo sicuro un valore mixed in string.
     * impostare delle eccezzioni ?
     *
     * @param  mixed  $value  Il valore da convertire
     * @return string Il valore convertito in string
     */
    public function execute(mixed $value): string
    {
        if (is_string($value)) {
            return $value;
        }
        /*
         * if ($value instanceof \BackedEnum) {
         * return $value->value;
         * }
         */

        if (is_null($value)) {
            return '';
        }

        if (is_bool($value)) {
            return $value ? '1' : '0';
        }

        if (is_scalar($value)) {
            return (string) $value;
        }

        // Oggetti convertibili in stringa (Stringable, Carbon, HtmlString, ...):
        // il cast nativo `(string) $value` qui produce la rappresentazione testuale,
        // quindi va preservata invece di appiattirla a stringa vuota.
        if ($value instanceof \Stringable || (is_object($value) && method_exists($value, '__toString'))) {
            return (string) $value;
        }

        // Per array e oggetti non convertibili (dove il cast nativo fallirebbe),
        // restituisci stringa vuota.
        return '';
    }

    /**
     * Metodo statico di convenienza per chiamate dirette.
     *
     * @param  mixed  $value  Il valore da convertire
     * @return string Il valore convertito in string
     */
    public static function cast(mixed $value): string
    {
        return app(self::class)->execute($value);
    }
}
