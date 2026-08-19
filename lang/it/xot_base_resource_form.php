<?php

declare(strict_types=1);

return [
    'steps' => [
        'privacy' => ['label' => 'privacy'],
        'data' => ['label' => 'data'],
        'summary' => ['label' => 'summary'],
    ],
    'fields' => [
        'id' => ['label' => 'id', 'placeholder' => 'id', 'helper_text' => 'id', 'description' => 'id'],
        'extra_attributes' => [
            'type' => ['label' => 'extra_attributes.type', 'placeholder' => 'extra_attributes.type', 'helper_text' => 'extra_attributes.type', 'description' => 'extra_attributes.type'],
            'anno' => ['label' => 'extra_attributes.anno', 'placeholder' => 'extra_attributes.anno', 'helper_text' => 'extra_attributes.anno', 'description' => 'extra_attributes.anno'],
        ],
        'title' => ['label' => 'title', 'placeholder' => 'title', 'helper_text' => 'title', 'description' => 'title'],
        'rule' => ['label' => 'rule', 'placeholder' => 'rule', 'helper_text' => 'rule', 'description' => 'rule'],
        'is_disabled' => ['label' => 'is_disabled', 'placeholder' => 'is_disabled', 'helper_text' => 'is_disabled', 'description' => 'is_disabled'],
        'is_readonly' => ['label' => 'is_readonly', 'placeholder' => 'is_readonly', 'helper_text' => 'is_readonly', 'description' => 'is_readonly'],
        'txt' => ['label' => 'txt', 'placeholder' => 'txt', 'helper_text' => 'txt', 'description' => 'txt'],
    ],
    'sections' => [
        'diritto' => ['label' => 'diritto', 'heading' => 'diritto'],
        'lavoratore' => ['label' => 'lavoratore', 'heading' => 'lavoratore'],
        'qua' => ['label' => 'qua', 'heading' => 'qua'],
        'rep' => ['label' => 'rep', 'heading' => 'rep'],
        'periodo' => ['label' => 'periodo', 'heading' => 'periodo'],
        'assenze' => ['label' => 'assenze', 'heading' => 'assenze'],
        'empty' => ['label' => 'empty', 'heading' => 'empty'],
    ],
];
