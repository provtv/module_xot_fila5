<<<<<<< .merge_file_s1zqQr
<<<<<<< HEAD
=======
>>>>>>> .merge_file_SgrF4I
---
title: "Git Forward-Only Rule (Xot)"
type: rule
tags: [git, forward-only, xot]
created: 2025-11-01
updated: 2026-07-22
qmd: "xot git forward-only no reset restore revert agent study show"
issues:
  - https://github.com/provtv/base_ptv_fila5/issues/124
discussions:
  - https://github.com/laraxot/base_ptv_fila5/discussions/273
---
<<<<<<< .merge_file_s1zqQr

# Git Forward-Only Rule

## Legge

**MAI TORNARE INDIETRO DI VERSIONE — SOLO AVANTI**

Canon monorepo: [`docs/wiki/rules/git-forward-only.md`](../../../../docs/wiki/rules/git-forward-only.md).

## Vietato (soprattutto agenti)

- `git reset` (hard/soft/mixed)
- `git restore` / `git checkout -- <file>`
- `git revert` come scorciatoia di fix (agenti: sempre vietato salvo ordine umano esplicito)
- `git push --force` su branch condivisi
- Riscrivere / cancellare commit dalla storia
- Copia cieca `git show <rev>:path > path`

## Obbligatorio

- Studiare il passato con `git show` / `log` / `blame`
- Correggere con **nuovo** codice + nuovo commit (quando l’utente lo chiede)
- Preservare history e tracciabilità
- Documentare il perché nel messaggio di commit

## Workflow

### Bug introdotto da un commit

```bash
# ❌
git reset --hard HEAD~1
git restore -- path
git revert HEAD

# ✅
# studia: git show <sha>:path
# edita il file corrente (versione migliorata)
git add path
git commit -m "fix: corregge problema introdotto in <sha>"
```

### Segreti leaked

1. Rimuovi il segreto con un commit forward
2. Ruota le credenziali
3. Pulizia history (BFG) solo se deciso dall’umano — non dall’agente di default

### «Voglio la versione di prima»

Studia `git show` → riscrivi migliorato sullo stato attuale. Non restore.

## Branch

Gli agenti **non** creano/cambiano branch — vedi regola `agent-no-git-branch-creation`.

## Mantra

> Il codice va avanti, la storia resta. Non cancellare: correggi. Forward. Always.

**Ultima revisione:** 2026-07-22
=======
# Git Forward-Only Rule

## 🔥 Regola Assoluta: Mai Tornare Indietro

### La Legge

**MAI TORNARE INDIETRO DI VERSIONE - SOLO AVANTI**

Questa non è una raccomandazione, è una **legge del progetto**.

## ❌ Cosa è VIETATO Assolutamente

- `git reset --hard` su commit pushati
- `git push --force` su branch condivisi (develop, main, release/*)
- Cancellare commit dalla storia
- `git rebase -i` su commit pubblici
- Modificare commit già pushati
- Riscrivere la storia del repository

## ✅ Cosa è OBBLIGATORIO

- Nuovi commit per correggere errori
- `git revert` per annullare modifiche (crea nuovo commit di revert)
- Progressione forward-only
- Storia preservata SEMPRE
- Tracciabilità totale
- Documentare correzioni con commit message chiari

## Il Perché

### Filosofia: Progresso Lineare
Come il tempo, il codice procede solo in avanti. Gli errori sono parte del viaggio di apprendimento.
=======
>>>>>>> .merge_file_SgrF4I

# Git Forward-Only Rule

## Legge

**MAI TORNARE INDIETRO DI VERSIONE — SOLO AVANTI**

Canon monorepo: [`docs/wiki/rules/git-forward-only.md`](../../../../docs/wiki/rules/git-forward-only.md).

## Vietato (soprattutto agenti)

- `git reset` (hard/soft/mixed)
- `git restore` / `git checkout -- <file>`
- `git revert` come scorciatoia di fix (agenti: sempre vietato salvo ordine umano esplicito)
- `git push --force` su branch condivisi
- Riscrivere / cancellare commit dalla storia
- Copia cieca `git show <rev>:path > path`

## Obbligatorio

- Studiare il passato con `git show` / `log` / `blame`
- Correggere con **nuovo** codice + nuovo commit (quando l’utente lo chiede)
- Preservare history e tracciabilità
- Documentare il perché nel messaggio di commit

## Workflow

### Bug introdotto da un commit

```bash
# ❌
git reset --hard HEAD~1
git restore -- path
git revert HEAD

# ✅
# studia: git show <sha>:path
# edita il file corrente (versione migliorata)
git add path
git commit -m "fix: corregge problema introdotto in <sha>"
```

### Segreti leaked

1. Rimuovi il segreto con un commit forward
2. Ruota le credenziali
3. Pulizia history (BFG) solo se deciso dall’umano — non dall’agente di default

### «Voglio la versione di prima»

Studia `git show` → riscrivi migliorato sullo stato attuale. Non restore.

## Branch

Gli agenti **non** creano/cambiano branch — vedi regola `agent-no-git-branch-creation`.

## Mantra

> Il codice va avanti, la storia resta. Non cancellare: correggi. Forward. Always.

<<<<<<< .merge_file_s1zqQr
**Ultima revisione**: Novembre 2025
**Status**: Regola Assoluta e Immutabile
>>>>>>> laraxot/master
=======
**Ultima revisione:** 2026-07-22
>>>>>>> .merge_file_SgrF4I
