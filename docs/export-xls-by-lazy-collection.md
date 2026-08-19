---
title: "Export XLS da LazyCollection"
type: concept
tags: [phpstan, lazycollection, export, invariante]
updated: 2026-08-18
qmd: "export xls lazycollection TValue invariante promoted property Model cursor"
related:
  - "./stories/5.10.mixed-narrowing-campaign.story.md"
  - "../../Ptv/docs/phpstan-ptv-patterns.md"
  - "../../Notify/docs/mixed-type-ultima-spiaggia.md"
---

# Export XLS da LazyCollection

`ExportXlsByLazyCollection` riceve il cursore Eloquent (`Builder::cursor()` →
`LazyCollection<int, Model>`) e lo passa a `LazyCollectionExport`.

`TValue` di `LazyCollection` **non è covariante**. `LazyCollection<int, Model>` e
`LazyCollection<int, mixed>` sono tipi distinti: dichiararne uno sul costruttore e
l'altro su `execute()` / `collection()` è un errore `argument.type` / `return.type`,
non un dettaglio di phpdoc.

Una promoted property `public LazyCollection $collection` **perde il generic** del
`@param`. PHPStan la vede come `<int, mixed>` anche se il costruttore dice `Model`.
Il generic sta sulla proprietà (come in `CollectionExport`), poi costruttore e
`collection()` ripetono lo stesso tipo.

`normalizeRow(mixed)` resta misto: `first()` può essere `null`, e il mapping Excel
accetta anche array. Il contenitore del cursore, sul path Filament, è `Model`.

Il gemello `ExportXlsStreamByLazyCollection` ha un ramo `is_array` nel corpo: non
allinearlo a `Model` solo per far sparire un rosso se un chiamante passa davvero
array. Oggi l'unico chiamante condiviso (`ExportXlsLazyAction`) passa lo stesso
cursore Eloquent a entrambi.

Vedi <https://phpstan.org/blog/whats-up-with-template-covariant>.
