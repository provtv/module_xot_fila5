<?php

declare(strict_types=1);

return [
    'navigation' => [
<<<<<<< HEAD
        'name' => 'cache',
        'plural' => 'cache',
        'group' => ['name' => 'Admin'],
    ],
    'pages' => [
        'health_check_results' => [
            'buttons' => ['refresh' => 'Refresh'],
            'heading' => 'Application Health',
            'navigation' => ['group' => 'Settings', 'label' => 'Application Health'],
            'notifications' => ['check_results' => 'Check results from'],
        ],
    ],
    'label' => 'Cache',
    'plural_label' => 'Cache (Plurale)',
    'fields' => [
        'id' => ['label' => 'Identificativo', 'tooltip' => 'Identificativo univoco del record', 'helper_text' => '', 'description' => ''],
        'created_at' => ['label' => 'Data Creazione', 'tooltip' => '', 'helper_text' => '', 'description' => ''],
        'updated_at' => ['label' => 'Ultima Modifica', 'tooltip' => '', 'helper_text' => '', 'description' => ''],
        'expiration' => ['label' => 'expiration', 'placeholder' => 'expiration', 'helper_text' => 'expiration', 'description' => 'expiration'],
<<<<<<< .merge_file_VPhPi7
    ],
    'actions' => [
        'create' => ['label' => 'Crea Cache', 'icon' => 'create', 'tooltip' => 'create'],
        'edit' => ['label' => 'Modifica Cache', 'icon' => 'edit', 'tooltip' => 'edit'],
        'delete' => ['label' => 'Elimina Cache', 'icon' => 'delete', 'tooltip' => 'delete'],
        'route:list' => ['label' => 'route:list', 'icon' => 'route:list', 'tooltip' => 'route:list'],
        'icons:cache' => ['label' => 'icons:cache', 'icon' => 'icons:cache', 'tooltip' => 'icons:cache'],
        'filament:cache-components' => ['label' => 'filament:cache-components', 'icon' => 'filament:cache-components', 'tooltip' => 'filament:cache-components'],
        'filament:clear-cached-components' => ['label' => 'filament:clear-cached-components', 'icon' => 'filament:clear-cached-components', 'tooltip' => 'filament:clear-cached-components'],
        'view' => ['label' => 'view', 'icon' => 'view', 'tooltip' => 'view'],
        'createAnother' => ['label' => 'createAnother', 'icon' => 'createAnother', 'tooltip' => 'createAnother'],
        'save' => ['label' => 'save', 'icon' => 'save', 'tooltip' => 'save'],
        'layout' => ['label' => 'layout', 'icon' => 'layout', 'tooltip' => 'layout'],
    ],
=======
        'name' => 'Cache',
        'plural' => 'Cache',
        'group' => [
            'name' => 'Sistema',
            'description' => 'Gestione della cache del sistema',
        ],
        'label' => 'cache',
        'sort' => 29,
        'icon' => 'xot-cache',
    ],
    'fields' => [
        'key' => [
            'label' => 'Chiave',
            'placeholder' => 'Inserisci la chiave',
            'help' => 'Chiave identificativa della cache',
        ],
        'value' => [
            'label' => 'Valore',
            'placeholder' => 'Inserisci il valore',
            'help' => 'Valore memorizzato nella cache',
        ],
        'ttl' => [
            'label' => 'Tempo di Vita',
            'placeholder' => 'Inserisci il TTL in minuti',
            'help' => 'Tempo di permanenza in cache (in minuti)',
        ],
        'tags' => [
            'label' => 'Tag',
            'placeholder' => 'Seleziona i tag',
            'help' => 'Tag per raggruppare elementi della cache',
        ],
        'size' => [
            'label' => 'Dimensione',
            'help' => 'Dimensione occupata in memoria',
        ],
        'driver' => [
            'label' => 'Driver',
            'help' => 'Driver di cache utilizzato',
            'options' => [
                'file' => 'File System',
                'redis' => 'Redis',
                'memcached' => 'Memcached',
                'array' => 'Array',
            ],
        ],
        'created_at' => [
            'label' => 'Data Creazione',
            'help' => 'Data di inserimento in cache',
        ],
        'expires_at' => [
            'label' => 'Data Scadenza',
            'help' => 'Data di scadenza della cache',
        ],
        'toggleColumns' => [
            'label' => 'toggleColumns',
        ],
        'reorderRecords' => [
            'label' => 'reorderRecords',
        ],
        'resetFilters' => [
            'label' => 'resetFilters',
        ],
        'applyFilters' => [
            'label' => 'applyFilters',
        ],
        'openFilters' => [
            'label' => 'openFilters',
        ],
    ],
    'actions' => [
        'clear' => [
            'label' => 'Svuota Cache',
            'success' => 'Cache svuotata con successo',
            'error' => 'Errore durante lo svuotamento della cache',
        ],
        'refresh' => [
            'label' => 'Aggiorna',
            'success' => 'Cache aggiornata con successo',
            'error' => 'Errore durante l\'aggiornamento della cache',
        ],
        'optimize' => [
            'label' => 'Ottimizza',
            'success' => 'Cache ottimizzata con successo',
            'error' => 'Errore durante l\'ottimizzazione della cache',
        ],
        'warm' => [
            'label' => 'Preriscalda',
            'success' => 'Cache preriscaldata con successo',
            'error' => 'Errore durante il preriscaldamento della cache',
        ],
    ],
    'messages' => [
        'validation' => [
            'key' => [
                'required' => 'La chiave è obbligatoria',
                'unique' => 'Questa chiave è già presente in cache',
            ],
            'ttl' => [
                'numeric' => 'Il TTL deve essere un numero',
                'min' => 'Il TTL deve essere maggiore di zero',
            ],
        ],
        'errors' => [
            'driver_not_supported' => 'Driver di cache non supportato',
            'key_not_found' => 'Chiave non trovata in cache',
            'storage_full' => 'Spazio cache esaurito',
            'connection_failed' => 'Connessione al server cache fallita',
        ],
        'info' => [
            'auto_cleanup' => 'Gli elementi scaduti verranno rimossi automaticamente',
            'memory_usage' => 'Utilizzo memoria cache: :usage',
            'hit_ratio' => 'Rapporto hit/miss: :ratio',
        ],
    ],
    'pages' => [
        'health_check_results' => [
            'buttons' => [
                'refresh' => 'Aggiorna',
            ],
            'heading' => 'Stato del Sistema',
            'navigation' => [
                'group' => 'Impostazioni',
                'label' => 'Stato del Sistema',
            ],
            'notifications' => [
                'check_results' => 'Risultati verifica da',
            ],
        ],
=======
    ],
    'actions' => [
        'create' => ['label' => 'Crea Cache', 'icon' => 'create', 'tooltip' => 'create'],
        'edit' => ['label' => 'Modifica Cache', 'icon' => 'edit', 'tooltip' => 'edit'],
        'delete' => ['label' => 'Elimina Cache', 'icon' => 'delete', 'tooltip' => 'delete'],
        'route:list' => ['label' => 'route:list', 'icon' => 'route:list', 'tooltip' => 'route:list'],
        'icons:cache' => ['label' => 'icons:cache', 'icon' => 'icons:cache', 'tooltip' => 'icons:cache'],
        'filament:cache-components' => ['label' => 'filament:cache-components', 'icon' => 'filament:cache-components', 'tooltip' => 'filament:cache-components'],
        'filament:clear-cached-components' => ['label' => 'filament:clear-cached-components', 'icon' => 'filament:clear-cached-components', 'tooltip' => 'filament:clear-cached-components'],
        'view' => ['label' => 'view', 'icon' => 'view', 'tooltip' => 'view'],
        'createAnother' => ['label' => 'createAnother', 'icon' => 'createAnother', 'tooltip' => 'createAnother'],
        'save' => ['label' => 'save', 'icon' => 'save', 'tooltip' => 'save'],
        'layout' => ['label' => 'layout', 'icon' => 'layout', 'tooltip' => 'layout'],
>>>>>>> .merge_file_DqGSmN
    ],
>>>>>>> laraxot/master
];
