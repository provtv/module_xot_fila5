<?php

declare(strict_types=1);

namespace Modules\Xot\Datas;

use Spatie\LaravelData\Data;

/**
<<<<<<< HEAD
* Class FilemanagerData - Gestisce la configurazione del file manager.
=======
 * Class FilemanagerData - Gestisce la configurazione del file manager.
>>>>>>> laraxot/dev
 * Utilizzato esclusivamente nell'ambito dell'architettura Filament-first.
 *
 * @phpstan-consistent-constructor
 */
final class FilemanagerData extends Data
{
    /**
     * @param array<int, string> $disks
     * @param array<int, string> $allowedExt
     */
    public function __construct(
        public readonly string $disk = 'public',
        public readonly array $disks = ['public'],
<<<<<<< HEAD
       public readonly array $allowedExt = [
=======
        public readonly array $allowedExt = [
>>>>>>> laraxot/dev
            'jpg', 'jpeg', 'png', 'gif', 'pdf', 'doc',
            'docx', 'xls', 'xlsx', 'zip',
        ],
        public readonly int $maxSize = 10,
        public readonly string $routePrefix = 'filemanager',
        public readonly bool $enableCrop = true,
    ) {
    }

    /**
     * Create a new instance of FilemanagerData with default values.
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
