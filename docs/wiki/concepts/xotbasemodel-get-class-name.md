---
title: "XotBaseModel::getClassName — risoluzione dal chiamante (backtrace)"
type: concept
module: Xot
status: active
tags: [xotbasemodel, getclassname, phpstan, dry, leaf, models, backtrace]
created: 2026-07-27
updated: 2026-08-05
qmd: "XotBaseModel getClassName senza argomenti debug_backtrace namespace chiamante CriteriOption BaseScheda Filament getModelClass"
related:
  - ./basemodel-connection-religion.md
  - ../../../Ptv/docs/wiki/concepts/criteri-model-class-resolution.md
  - ../../../Ptv/docs/dynamic-class-resolution-pattern.md
---

# XotBaseModel::getClassName

> **Rettifica 2026-08-05.** La versione 2026-07-27 di questa pagina (e la gemella Ptv)
> descriveva una firma `getClassName(string $fallback)` basata su LSB e bollava
> `CriteriOption::getClassName()` come anti-pattern. **Era l'opposto del vero.**
> Quella firma non è mai esistita nel codice; tutti i call site usano — correttamente —
> la forma senza argomenti. Un agente si è fidato della doc invece del codice e ha
> riscritto i chiamanti sulla firma inventata. Vedi §Perché la doc era sbagliata.

## Perché

I modelli base di piattaforma (es. `Ptv\Models\BaseScheda`) devono agganciare i modelli
del **modulo che li sta usando** (`Progressioni\Models\CriteriOption`), non i concreti
del modulo base (`Ptv\Models\CriteriOption`).

Il punto chiave: `static::class` **non basta**. In `CriteriOption::getClassName()` la
Late Static Binding vale `Ptv\Models\CriteriOption`, cioè il prototype, mai il leaf.
Il namespace del leaf non è ricavabile dalla classe invocata: va preso da **chi chiama**.

## API

```php
/** @return class-string<EloquentModel> */
public static function getClassName(): string
```

Nessun argomento. L'algoritmo:

1. `debug_backtrace()` → primo frame con un `object` la cui classe contiene `Models\`
   oppure `Filament\Resources\`: è il chiamante reale (la `Scheda` del leaf, o la
   Resource Filament).
2. Se quell'oggetto espone `getModelClass()`, usa quello (caso Filament).
3. `namespace` = ciò che precede `\Models\` nella classe del chiamante.
4. `className` = basename di `static::class` (`CriteriOption`).
5. Risultato `{namespace}\Models\{className}`, validato con `Assert::classExists` +
   `Assert::subclassOf(EloquentModel::class)`.

## Chiamata corretta

```php
// dentro Ptv\Models\BaseScheda, istanziata come Progressioni\Models\Scheda
CriteriOption::getClassName();      // → Progressioni\Models\CriteriOption
CriteriEsclusione::getClassName();  // → Progressioni\Models\CriteriEsclusione

// da contesto Filament: risolve via getModelClass() del chiamante
(StabiDirigente::getClassName())::query()
```

Il soggetto della chiamata è il **prototype da risolvere**, non il modello corrente:
si legge «dammi il `CriteriOption` di chi mi sta chiamando».

## Anti-pattern

```php
static::getClassName(CriteriOption::class);  // ❌ firma inesistente
$model::getClassName(Scheda::class);         // ❌ idem
```

## Fragilità note (reali — non "correggerle" alla cieca)

- Dipende da `debug_backtrace()`: invocato fuori da un frame `Models\` o
  `Filament\Resources\` lancia `RuntimeException`. È voluto: meglio fallire che
  agganciare in silenzio il modello del modulo sbagliato.
- PHPStan non può inferire il ritorno oltre l'annotazione: sono gli `Assert::` finali
  a rendere onesto `@return class-string<EloquentModel>`.

## Perché la doc era sbagliata

La pagina nacque il 2026-07-27 come **proposta di fix**, non come descrizione
dell'esistente («Fix: implementare `XotBaseModel::getClassName` + chiamate
`static::getClassName(...)`»), ma era scritta all'indicativo presente. Il metodo reale
è stato poi rimosso dal file in un commit del 2026-08-05, lasciando i chiamanti orfani.
Chi ha trovato gli errori PHPStan ha letto la proposta come canone.

Due regole ne discendono:

1. Una doc che propone un design deve dichiararlo (`status: proposed`) e non usare
   l'indicativo presente come se il codice esistesse.
2. Davanti a un metodo chiamato da N punti ma introvabile, la prima mossa è
   `git log -S "<metodo>" -- <file>`: quasi sempre è stato cancellato, non mai scritto.
   Vedi [recuperare-codice-cancellato-prima-di-riscriverlo](../../../../../../docs/wiki/rules/recuperare-codice-cancellato-prima-di-riscriverlo.md).

## Vedi

- [criteri-model-class-resolution](../../../Ptv/docs/wiki/concepts/criteri-model-class-resolution.md)
