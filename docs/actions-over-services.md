---
title: "Action al posto dei Service, e il trait prima dell'Action"
module: Xot
type: rule
tags: [actions, services, traits, spatie, architettura, dry]
created: 2026-08-24
updated: 2026-08-24
qmd: "spatie queueable action invece di service trait esistente HasRatingsTrait execute"
related:
  - "./actions-pattern.md"
  - "./action-return-type-rule.md"
  - "../../Rating/docs/README.md"
---

# Action al posto dei Service

## La regola

**I Service non si creano più.** La logica di business riutilizzabile vive in
[Spatie Queueable Action](https://github.com/spatie/laravel-queueable-action), invocate
con `app(<Classe>::class)->execute(...)`.

```php
// sbagliato: un Service, e un metodo che non è execute()
app(CreateClientAction::class)->createPersonalAccessClient($name);

// corretto
app(CreateClientAction::class)->execute($name);
```

Non si accumulano collaboratori nel costruttore per portarseli dietro: l'Action risolve da
sé ciò che le serve e resta accodabile.

```php
// sbagliato
public function __construct(
    private readonly DatabaseManager $dbManager,
    private readonly LoggerInterface $logger,
    private readonly Hasher $hasher,
) {}
```

## Prima dell'Action viene il trait

La regola sopra dice *come* scrivere la logica nuova. Questa dice quando **non** scriverne
affatto.

Prima di creare un file nuovo — Action, Service o qualunque cosa — si verifica che la
soluzione non esista già:

1. **Un trait rilevante.** I trait forniscono relazioni e logica condivisa. Se il trait
   già gestisce il caso, l'Action non va creata.
2. **Un'Action già presente** nello stesso modulo o in `Xot`.
3. **Un Service preesistente** da migrare, non da affiancare.

Come si cerca:

```bash
qmd search "<funzione> trait" --limit 5
rg -n "HasRatingsTrait" laravel/Modules
```

### Esempio concreto

| | |
|---|---|
| ❌ | Creare `RatingsService.php` o `RatingsAction.php` quando `HasRatingsTrait` esiste |
| ✅ | Verificare che il trait sia già incluso nel modello (`BaseScheda.php`) |
| ✅ | Documentare l'esistenza del trait e l'uso corretto, invece di duplicarlo |

### Dove stanno i trait

- Rating: `laravel/Modules/Rating/app/Models/Traits/HasRatingsTrait.php`
- Per gli altri: nel modulo di dominio, oppure in `Xot` se è trasversale.

## Perché

Un'Action che duplica un trait non è codice in più: è una seconda verità sullo stesso
comportamento. Quando le due divergono — e divergono — nessuno sa quale delle due il
modello stia effettivamente usando. Il costo non è la riga scritta, è la riga che
qualcuno leggerà fra sei mesi.
