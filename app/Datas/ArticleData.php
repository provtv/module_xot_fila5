<?php

declare(strict_types=1);

namespace Modules\Xot\Datas;

use Spatie\LaravelData\Data;

/**
<<<<<<< HEAD
* Class ArticleData - Gestisce la configurazione degli articoli.
=======
 * Class ArticleData - Gestisce la configurazione degli articoli.
>>>>>>> laraxot/dev
 * Utilizzato esclusivamente nell'ambito dell'architettura Filament-first.
 *
 * @phpstan-consistent-constructor
 */
final class ArticleData extends Data
{
    /**
     * @param array<int, string>    $types
     * @param array<int, string>    $categories
     * @param array<string, string> $defaultMeta
     * @param array<string, bool>   $features
     */
    public function __construct(
        public readonly array $types = ['post', 'page', 'news'],
        public readonly array $categories = [],
<<<<<<< HEAD
       public readonly string $editor = 'markdown',
=======
        public readonly string $editor = 'markdown',
>>>>>>> laraxot/dev
        public readonly array $defaultMeta = [
            'title' => '',
            'description' => '',
            'keywords' => '',
        ],
<<<<<<< HEAD
       public readonly array $features = [
=======
        public readonly array $features = [
>>>>>>> laraxot/dev
            'enable_comments' => true,
            'moderate_comments' => true,
            'enable_rating' => false,
            'show_author' => true,
            'show_date' => true,
            'show_reading_time' => true,
        ],
    ) {
    }

    /**
     * Create a new instance of ArticleData with default values.
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
