<?php

declare(strict_types=1);

namespace Modules\Xot\Actions\Collection;

use Illuminate\Support\Collection;
use Modules\Xot\Actions\Cast\SafeStringCastAction;
use Spatie\QueueableAction\QueueableAction;

/**
 * Action per la traduzione di elementi di una collezione.
 */
class TransCollectionAction
{
    use QueueableAction;

    public ?string $transKey;

    /**
     * Esegue la traduzione di una collezione.
     *
     * @param  Collection<int|string, mixed>  $collection
     * @return Collection<int|string, string>
     */
    public function execute(Collection $collection, ?string $transKey): Collection
    {
        if ($transKey === null) {
            return $collection->map(SafeStringCastAction::cast(...));
        }

        $this->transKey = $transKey;

        // Il cast a stringa precede la traduzione: `trans()` riceve così `string`,
        // e la collection su cui mappa è `Collection<int|string, string>`.
        return $collection
            ->map(SafeStringCastAction::cast(...))
            ->map($this->trans(...));
    }

    /**
     * Traduce un singolo elemento.
     *
     * @return string L'elemento tradotto o l'elemento originale se la traduzione non esiste
     */
    public function trans(string $item): string
    {
        if (empty($item) || $this->transKey === null) {
            return $item;
        }

        // Prima prova la traduzione diretta
        $key = $this->transKey.'.'.$item;
        $trans = trans($key);

        // Se la traduzione esiste ed è una stringa, la restituisce
        if ($trans !== $key && \is_string($trans)) {
            return $trans;
        }

        // Seconda prova: sostituisce i punti con underscore
        $itemWithUnderscore = str_replace('.', '_', $item);
        $keyWithUnderscore = $this->transKey.'.'.$itemWithUnderscore;
        $transWithUnderscore = trans($keyWithUnderscore);

        // Se la traduzione con underscore esiste ed è una stringa, la restituisce
        if ($transWithUnderscore !== $keyWithUnderscore && \is_string($transWithUnderscore)) {
            return $transWithUnderscore;
        }

        // Se nessuna traduzione è stata trovata, restituisce l'elemento originale
        return $item;
    }
}
