<?php

declare(strict_types=1);

namespace Modules\Xot\Datas;

use Spatie\LaravelData\Data;

/**
<<<<<<< HEAD
* Class CookieData - Gestisce la configurazione dei cookie.
=======
 * Class CookieData - Gestisce la configurazione dei cookie.
>>>>>>> laraxot/dev
 * Utilizzato esclusivamente nell'ambito dell'architettura Filament-first.
 *
 * @phpstan-consistent-constructor
 *
 * @param bool   $accept
 * @param string $type
 * @param int    $durationDays
 * @param string $policyUrl
 * @param string $bannerStyle
 */
final class CookieData extends Data
{
    public function __construct(
        public readonly bool $accept = false,
        public readonly string $type = 'necessary',
        public readonly int $durationDays = 365,
        public readonly string $policyUrl = '/cookie-policy',
        public readonly string $bannerStyle = 'bottom',
    ) {
    }

    /**
     * Create a new instance of CookieData with default values.
     */
<<<<<<< HEAD
   public static function make(): self
=======
    public static function make(): self
>>>>>>> laraxot/dev
    {
        return new self();
    }
}
