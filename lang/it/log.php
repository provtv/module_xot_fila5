<?php

declare(strict_types=1);

return [
    'resources' => 'Risorse',
    'pages' => 'Pagine',
    'widgets' => 'Widgets',
    'navigation' => [
        'name' => 'log',
        'plural' => 'logs',
        'group' => ['name' => 'Admin'],
    ],
    'fields' => [
        'name' => ['label' => 'Nome', 'tooltip' => '', 'helper_text' => '', 'description' => '', 'placeholder' => 'name'],
        'guard_name' => ['label' => 'Guard', 'tooltip' => '', 'helper_text' => '', 'description' => ''],
        'permissions' => ['label' => 'Permessi', 'tooltip' => '', 'helper_text' => '', 'description' => ''],
        'updated_at' => ['label' => 'Aggiornato il', 'tooltip' => '', 'helper_text' => '', 'description' => ''],
        'first_name' => ['label' => 'Nome', 'tooltip' => '', 'helper_text' => '', 'description' => ''],
        'last_name' => ['label' => 'Cognome', 'tooltip' => '', 'helper_text' => '', 'description' => ''],
        'select_all' => ['name' => 'Seleziona Tutti', 'message' => '', 'label' => '', 'tooltip' => '', 'helper_text' => '', 'description' => ''],
        'id' => ['label' => 'id'],
        'level_name' => ['label' => 'level_name'],
        'created_at' => ['label' => 'created_at'],
        'path' => ['label' => 'path', 'placeholder' => 'path', 'helper_text' => 'path', 'description' => 'path'],
        'content' => ['label' => 'content', 'placeholder' => 'content', 'helper_text' => 'content', 'description' => 'content'],
        'file-content' => ['label' => 'file-content'],
    ],
    'actions' => [
        'import' => [
            'fields' => ['import_file' => 'Seleziona un file XLS o CSV da caricare'],
        ],
        'export' => [
            'filename_prefix' => 'Aree al',
            'columns' => ['name' => 'Nome area', 'parent_name' => 'Nome area livello superiore'],
        ],
        'delete' => ['label' => 'delete', 'icon' => 'delete', 'tooltip' => 'delete'],
        'create' => ['label' => 'create', 'icon' => 'create', 'tooltip' => 'create'],
        'view' => ['icon' => 'view', 'tooltip' => 'view'],
        'createAnother' => ['label' => 'createAnother', 'icon' => 'createAnother', 'tooltip' => 'createAnother'],
        'save' => ['label' => 'save', 'icon' => 'save', 'tooltip' => 'save'],
        'layout' => ['label' => 'layout', 'icon' => 'layout', 'tooltip' => 'layout'],
        'edit' => ['label' => 'edit', 'icon' => 'edit', 'tooltip' => 'edit'],
    ],
    'label' => 'Log',
    'plural_label' => 'Log (Plurale)',
    'title' => 'log',
    'plural' => ['label' => 'log.plural'],
    'test' => 'log',
];
