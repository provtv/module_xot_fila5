---
title: "Coverage dei moduli — baseline misurata"
module: Xot
type: reference
status: approved
language: it-IT
created: 2026-08-05
updated: 2026-08-19
qmd: "coverage baseline moduli statement clover pest phpunit floor 50 percento gap"
related:
  - ./stories/5.24.module-coverage-fifty-percent-floor.story.md
  - ./stories/5.22.module-coverage-plus-ten-campaign.story.md
  - ./stories/5.25.module-suite-green-offline.story.md
  - ../../../../docs/chat/coverage-misurabilita-suite-moduli.md
---

# Coverage dei moduli — baseline misurata

Prima misura reale del repo. Il contenuto precedente di questo file era un segnaposto con
tutti zeri che dichiarava «comprehensive test coverage» e «all tests are passing»: non
descriveva niente di esistente.

## Come è stata prodotta

```bash
# cwd: laravel/
XDEBUG_MODE=coverage ./vendor/bin/pest -c Modules/{Mod}/phpunit.xml \
  --coverage --coverage-clover build/coverage-baseline/clover-{Mod}.xml --min=0
```

Le percentuali sotto sono calcolate dai file clover, sul rapporto
`coveredstatements / statements` di `<project><metrics>`. Perimetro per modulo:
`<source><include><directory suffix=".php">./app</directory>` dichiarato nella
`Modules/{Mod}/phpunit.xml` del modulo — **non** il perimetro della config di root, che
misura solo `laravel/app`.

## Baseline 2026-08-19

| Modulo | Coverage | Coperti | Statement | Mancano per il 50 % |
|---|---:|---:|---:|---:|
| **Rating** | **70,9 %** | 442 | 623 | ✅ già sopra |
| Tenant | 34,9 % | 321 | 919 | 139 |
| Activity | 29,0 % | 223 | 770 | 162 |
| Lang | 21,3 % | 238 | 1 116 | 320 |
| Notify | 15,4 % | 786 | 5 101 | 1 765 |
| Media | 13,4 % | 418 | 3 130 | 1 147 |
| UI | 11,4 % | 198 | 1 740 | 672 |
| Job | 10,3 % | 216 | 2 091 | 830 |
| Performance | 5,2 % | 299 | 5 754 | 2 578 |
| IndennitaCondizioniLavoro | 3,6 % | 61 | 1 715 | 797 |
| IndennitaResponsabilita | 3,1 % | 84 | 2 688 | 1 260 |
| Ptv | 2,9 % | 201 | 6 980 | 3 289 |
| Sigma | 0,1 % | 7 | 5 067 | 2 527 |
| Progressioni | 0,0 % | 1 | 5 115 | 2 557 |
| Pdnd | 0,0 % | 0 | 6 327 | 3 164 |
| **Totale misurato** | **7,1 %** | **3 495** | **49 136** | **~21 200** |

Tre moduli non hanno prodotto un clover:

| Modulo | Perché |
|---|---|
| Incentivi | fatal in `tests/Unit/Models/Policies/*PolicyTest.php`: `new class($employeeId) extends User` — vedi sotto |
| User | run non conclusa entro la finestra di misura |
| Xot | misura non ancora eseguita |

## Cosa dicono questi numeri

- **Un solo modulo su 15 supera il 50 %**: Rating, che è anche il più piccolo (623
  statement). Il floor della story
  [5.24](./stories/5.24.module-coverage-fifty-percent-floor.story.md) è lontano.
- **Tre moduli sono a zero** — Pdnd, Progressioni, Sigma — e insieme valgono 16 509
  statement, un terzo del perimetro totale. Non è debito di rifinitura: è codice mai
  eseguito da un test.
- **I quattro obiettivi vicini** sono Tenant (+139), Activity (+162), Lang (+320) e
  UI (+672). Sono gli unici dove il 50 % è a portata di una sessione.
- Il totale, **7,1 %**, è la cifra da citare quando si parla di «coverage del progetto»:
  l'85 % di NFR-CQ-002 non è una rifinitura, è un programma.

## Trappole di misura, verificate

1. **Pest stampa la tabella di coverage solo se il run esce `0`.** Con un solo test rosso
   `--coverage` non produce nulla e sembra ignorato. Il clover invece viene scritto lo
   stesso: per questo la tabella qui sopra esiste anche per moduli con suite rossa — è
   coverage **reale ma parziale**, perché i test falliti non eseguono il codice che
   avrebbero coperto. Quando la suite diventerà verde queste percentuali **saliranno da
   sole**, senza scrivere un test in più.
2. **`--coverage-filter` da CLI è accettato e ignorato**: sposta il perimetro solo la
   `phpunit.xml` del modulo.
3. **Xdebug è l'unico driver** (`pcov` non è installato) e `XDEBUG_MODE=coverage` è
   obbligatorio, altrimenti `ERROR Unable to get coverage using Xdebug`. Il run è lento:
   misurare un modulo alla volta.
4. **Le classi anonime rompono la misura.** `new class extends X` produce un nome che
   contiene un byte NUL (`class@anonymous\0/path.php:riga`); il codice Xot che deriva da
   `static::class` il path di un file di lingua lo passa a `file_put_contents()`, che
   solleva `ValueError: must not contain any null bytes`. È la causa del fatal di Incentivi.
   Per testare una classe astratta serve una **sottoclasse nominata** dentro il file di test.

## Il tetto che nessuna di queste percentuali può superare oggi

`database/fixcity_data.sqlite`, su cui `XotBaseTestCase` rimappa ogni connessione, contiene
sette tabelle e nessuna di dominio. Ogni test che tocca lo schema fallisce con
`no such table`, e il codice che avrebbe coperto non viene eseguito. Finché non si decide
come dare uno schema all'ambiente di test, una parte del perimetro è **incoperibile per
costruzione**, non per mancanza di test. Le tre vie sono in
[5.25](./stories/5.25.module-suite-green-offline.story.md).

Nota d'ambiente: un MySQL **locale** ascolta su `127.0.0.1:3306`, ma le credenziali di
`.env.testing` (`personale`) non vi hanno accesso. Se esistono credenziali valide, la via C
— quella conforme ad AD-3 — è una riga in `.env.testing`, non un progetto.
