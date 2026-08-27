<?php

declare(strict_types=1);

<<<<<<< HEAD
return [
    'navigation' => [
        'name' => 'Env',
        'plural' => 'Env',
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
    'label' => 'Env',
    'plural_label' => 'Env (Plurale)',
    'fields' => [
        'id' => [
            'label' => 'Identificativo',
            'tooltip' => 'Identificativo univoco del record',
            'helper_text' => '',
            'description' => '',
        ],
        'created_at' => [
            'label' => 'Data Creazione',
            'tooltip' => '',
            'helper_text' => '',
            'description' => '',
        ],
        'updated_at' => [
            'label' => 'Ultima Modifica',
            'tooltip' => '',
            'helper_text' => '',
            'description' => '',
        ],
        'app_url' => [
            'label' => 'app_url',
            'placeholder' => 'app_url',
            'helper_text' => 'app_url',
            'description' => 'app_url',
<<<<<<< .merge_file_g6U0LS
        ],
        'debugbar_enabled' => [
            'label' => 'debugbar_enabled',
            'placeholder' => 'debugbar_enabled',
            'helper_text' => 'debugbar_enabled',
            'description' => 'debugbar_enabled',
        ],
        'google_maps_api_key' => [
            'label' => 'google_maps_api_key',
            'placeholder' => 'google_maps_api_key',
            'helper_text' => 'google_maps_api_key',
            'description' => 'google_maps_api_key',
        ],
        'telegram_bot_token' => [
            'placeholder' => 'telegram_bot_token',
        ],
    ],
    'actions' => [
        'create' => ['label' => 'Crea Env'],
        'edit' => ['label' => 'Modifica Env'],
        'delete' => ['label' => 'Elimina Env'],
        'save' => ['label' => 'save', 'icon' => 'save', 'tooltip' => 'save'],
    ],
    'test' => 'env',
    'plural' => ['label' => 'env.plural'],
=======

return [
    'navigation' => [
        'name' => 'Ambiente',
        'plural' => 'Ambiente',
        'group' => [
            'name' => 'Sistema',
            'description' => 'Gestione delle variabili d\'ambiente e configurazione del sistema',
        ],
        'label' => 'env',
        'sort' => 12,
        'icon' => 'xot-env',
    ],
    'fields' => [
        'key' => [
            'label' => 'Chiave',
            'placeholder' => 'Inserisci la chiave (es. APP_NAME)',
            'help' => 'Nome della variabile d\'ambiente in maiuscolo',
        ],
        'value' => [
            'label' => 'Valore',
            'placeholder' => 'Inserisci il valore',
            'help' => 'Valore della variabile d\'ambiente',
        ],
        'type' => [
            'label' => 'Tipo',
            'placeholder' => 'Seleziona il tipo di variabile',
            'help' => 'Tipo di dato della variabile',
            'options' => [
                'string' => 'Testo',
                'integer' => 'Numero intero',
                'float' => 'Numero decimale',
                'boolean' => 'Booleano',
                'array' => 'Array',
                'null' => 'Nullo',
            ],
        ],
        'environment' => [
            'label' => 'Ambiente',
            'placeholder' => 'Seleziona l\'ambiente di applicazione',
            'help' => 'Ambiente in cui la variabile è attiva',
            'options' => [
                'local' => 'Sviluppo locale',
                'testing' => 'Test',
                'staging' => 'Pre-produzione',
                'production' => 'Produzione',
                'all' => 'Tutti gli ambienti',
            ],
        ],
        'is_sensitive' => [
            'label' => 'Dato Sensibile',
            'help' => 'Indica se il valore contiene dati sensibili da mascherare',
        ],
        'description' => [
            'label' => 'Descrizione',
            'placeholder' => 'Inserisci una descrizione',
            'help' => 'Descrizione dettagliata dello scopo della variabile',
        ],
        'group' => [
            'label' => 'Gruppo',
            'placeholder' => 'Seleziona il gruppo',
            'help' => 'Gruppo funzionale della variabile',
            'options' => [
                'app' => 'Applicazione',
                'database' => 'Database',
                'mail' => 'Email',
                'queue' => 'Code',
                'cache' => 'Cache',
                'services' => 'Servizi',
                'other' => 'Altro',
            ],
        ],
        'telegram_bot_token' => [
            'description' => 'telegram_bot_token',
            'helper_text' => 'telegram_bot_token',
            'placeholder' => 'telegram_bot_token',
            'label' => 'telegram_bot_token',
        ],
        'google_maps_api_key' => [
            'description' => 'google_maps_api_key',
            'helper_text' => 'google_maps_api_key',
        ],
    ],
    'actions' => [
        'create' => [
            'label' => 'Nuova Variabile',
            'success' => 'Variabile d\'ambiente creata con successo',
            'error' => 'Errore durante la creazione della variabile',
        ],
        'edit' => [
            'label' => 'Modifica',
            'success' => 'Variabile d\'ambiente aggiornata con successo',
            'error' => 'Errore durante l\'aggiornamento della variabile',
        ],
        'delete' => [
            'label' => 'Elimina',
            'success' => 'Variabile d\'ambiente eliminata con successo',
            'error' => 'Errore durante l\'eliminazione della variabile',
        ],
        'backup' => [
            'label' => 'Backup',
            'success' => 'Backup del file .env creato con successo',
            'error' => 'Errore durante la creazione del backup',
        ],
        'restore' => [
            'label' => 'Ripristina',
            'success' => 'File .env ripristinato con successo',
            'error' => 'Errore durante il ripristino del file',
        ],
        'encrypt' => [
            'label' => 'Cripta',
            'success' => 'Valore criptato con successo',
            'error' => 'Errore durante la criptazione',
        ],
    ],
    'messages' => [
        'validation' => [
            'key' => [
                'required' => 'La chiave è obbligatoria',
                'unique' => 'Questa chiave è già in uso',
                'regex' => 'La chiave può contenere solo lettere maiuscole, numeri e underscore',
                'reserved' => 'Questa chiave è riservata dal sistema',
            ],
            'value' => [
                'required' => 'Il valore è obbligatorio',
                'type' => 'Il valore deve essere del tipo :type',
            ],
            'environment' => [
                'required' => 'L\'ambiente è obbligatorio',
                'exists' => 'L\'ambiente selezionato non è valido',
            ],
        ],
        'warnings' => [
            'production_edit' => 'Attenzione: stai modificando variabili d\'ambiente in produzione',
            'backup_recommended' => 'Si consiglia di effettuare un backup prima di procedere',
            'sensitive_data' => 'Attenzione: questo valore contiene dati sensibili',
            'restart_required' => 'Potrebbe essere necessario riavviare l\'applicazione',
        ],
        'info' => [
            'env_loaded' => 'File .env caricato correttamente',
            'backup_created' => 'Backup creato in :path',
            'changes_saved' => 'Modifiche salvate nel file .env',
=======
        ],
        'debugbar_enabled' => [
            'label' => 'debugbar_enabled',
            'placeholder' => 'debugbar_enabled',
            'helper_text' => 'debugbar_enabled',
            'description' => 'debugbar_enabled',
        ],
        'google_maps_api_key' => [
            'label' => 'google_maps_api_key',
            'placeholder' => 'google_maps_api_key',
            'helper_text' => 'google_maps_api_key',
            'description' => 'google_maps_api_key',
>>>>>>> .merge_file_XF3jG5
        ],
        'telegram_bot_token' => [
            'placeholder' => 'telegram_bot_token',
        ],
    ],
    'actions' => [
        'create' => ['label' => 'Crea Env'],
        'edit' => ['label' => 'Modifica Env'],
        'delete' => ['label' => 'Elimina Env'],
        'save' => ['label' => 'save', 'icon' => 'save', 'tooltip' => 'save'],
    ],
<<<<<<< .merge_file_g6U0LS
    'title' => 'env',
>>>>>>> laraxot/master
=======
    'test' => 'env',
    'plural' => ['label' => 'env.plural'],
>>>>>>> .merge_file_XF3jG5
];
