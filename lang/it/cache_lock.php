<?php

declare(strict_types=1);

return [
    'navigation' => [
        'name' => 'cache lock',
        'plural' => 'cache locks',
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
    'label' => 'Cache Lock',
    'plural_label' => 'Cache Lock (Plurale)',
    'fields' => [
        'id' => ['label' => 'Identificativo', 'tooltip' => 'Identificativo univoco del record', 'helper_text' => '', 'description' => ''],
        'created_at' => ['label' => 'Data Creazione', 'tooltip' => '', 'helper_text' => '', 'description' => ''],
        'updated_at' => ['label' => 'Ultima Modifica', 'tooltip' => '', 'helper_text' => '', 'description' => ''],
    ],
    'actions' => [
        'create' => ['label' => 'Crea Cache Lock', 'icon' => 'create', 'tooltip' => 'create'],
        'edit' => ['label' => 'Modifica Cache Lock', 'icon' => 'edit', 'tooltip' => 'edit'],
        'delete' => ['label' => 'Elimina Cache Lock', 'icon' => 'delete', 'tooltip' => 'delete'],
        'view' => ['label' => 'view', 'icon' => 'view', 'tooltip' => 'view'],
        'createAnother' => ['label' => 'createAnother', 'icon' => 'createAnother', 'tooltip' => 'createAnother'],
        'save' => ['label' => 'save', 'icon' => 'save', 'tooltip' => 'save'],
        'layout' => ['label' => 'layout', 'icon' => 'layout', 'tooltip' => 'layout'],
    ],
];
