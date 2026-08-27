<<<<<<< HEAD
---
module: theme
topic: module-namespace
canonical: ../../../Themes/docs/shared-components/module-namespace-rules.md
---

<<<<<<< .merge_file_91i1Pn
See canonical documentation: ../../../Themes/docs/shared-components/module-namespace-rules.md
=======
# Regola generale: Label e traduzioni in Filament

## Regola
- Label, heading, placeholder, help SOLO in file di traduzione modulo.
- Nessun uso di ->label() nei file Filament.
- La label viene applicata automaticamente da LangServiceProvider tramite AutoLabelAction.
- Convenzione chiavi: `modulo.resource.fields.campo.label` o `modulo.resource.actions.azione.label`.

## Pattern
- Nessuna label hardcoded.
- Tutte le chiavi di traduzione devono essere presenti e coerenti.

## Anti-pattern
- Uso di ->label() nei componenti Filament.
- Label hardcoded.

## Test di regressione
- Test statico che cerca ->label( nei file Filament.
- Test che verifica la presenza di tutte le chiavi di traduzione.

## Collegamenti
- [docs root](../../../../docs/actions.md)
- [docs Lang](../../lang/docs/filament-label.md)

Ultimo aggiornamento: maggio 2025.
>>>>>>> laraxot/master
=======
See canonical documentation: ../../../Themes/docs/shared-components/module-namespace-rules.md
>>>>>>> .merge_file_Q6b0RR
