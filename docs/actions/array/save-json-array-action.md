---
title: "SaveJsonArrayAction"
module: "xot"
type: reference
status: approved
tags: [actions, arr, json, save]
created: 2026-08-19
updated: 2026-08-19
qmd: "save json array action xot arr namespace file write bool return"
related:
  - "../arr-namespace-convention.md"
  - "../actions-pattern.md"
---

# SaveJsonArrayAction

Namespace: `Modules\Xot\Actions\Arr\SaveJsonArrayAction`

Scrive un array PHP su file JSON con `JSON_PRETTY_PRINT`.

## Utilizzo

```php
$ok = app(\Modules\Xot\Actions\Arr\SaveJsonArrayAction::class)->execute(
    ['key' => 'value'],
    '/path/to/file.json'
);
// $ok: bool — true se scrittura riuscita
```

Via facade formato:

```php
app(\Modules\Xot\Actions\Arr\SaveArrayAction::class)->execute($data, $path, 'json');
```

Vedi [`arr-namespace-convention.md`](../arr-namespace-convention.md).
