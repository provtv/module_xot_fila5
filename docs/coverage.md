---
title: "Coverage dei moduli — baseline e gate floor 50%"
module: Xot
type: reference
status: approved
language: it-IT
created: 2026-08-05
updated: 2026-08-20
qmd: "coverage baseline moduli statement clover pest phpunit floor 50 percento gate wave"
related:
  - ./stories/5.24.module-coverage-fifty-percent-floor.story.md
  - ./stories/5.26.module-coverage-hundred-percent.story.md
  - ./testing-coverage-floor.md
  - ./stories/5.22.module-coverage-plus-ten-campaign.story.md
  - ./stories/5.25.module-suite-green-offline.story.md
  - ../../../../docs/chat/coverage-misurabilita-suite-moduli.md
  - ./wiki/concepts/module-test-skip-offline-pattern.md
---

# Coverage dei moduli — baseline e gate floor 50%

Prima misura reale del repo (clover 2026-08-19) + gate live story
[5.24](./stories/5.24.module-coverage-fifty-percent-floor.story.md). Target successivo 100%:
[5.26](./stories/5.26.module-coverage-hundred-percent.story.md).

## Comando gate (LOCKED)

```bash
# cwd: laravel/
XDEBUG_MODE=coverage ./vendor/bin/pest -c Modules/{Mod}/phpunit.xml \
  --coverage --min=50
```

Perimetro: `<source>` = solo `./app` in `Modules/{Mod}/phpunit.xml`. Report tabellare solo
su exit 0; il clover si scrive comunque con `--coverage-clover`.

## Anti-pattern vietato (story 5.26) — «il codice è poesia»

`Modules\Xot\Tests\ModuleExecuteCoverage::runFloor100` è **bannato**: lancia sempre
`RuntimeException`. Sweep che invocano metodi senza asserire il comportamento gonfiano la %
e falliscono il mutation score. I wrapper `*ExecuteCoverage100Test.php` sono stati rimossi.

Consentito (con giudizio): `runFloor50` / helper mirati (`testAllEnums`, policy con assert) solo
come **punto di partenza** verso floor 50%, mai come sostituto di test di dominio al 100%.

Regola: ogni test deve **fallire** se muti la logica che pretende di proteggere.

## Gate floor 50% — stato live (2026-08-20)

Misurato con suite verde e `--min=50` su `./app` full (**zero** `<exclude>` in `phpunit.xml`):

| Modulo | Coverage | Gate `--min=50` | Suite (pass / skip / fail) | Wave |
|--------|----------:|:---------------:|----------------------------|:----:|
| **Rating** | **100,0 %** | ✅ | 102 / 7 / 0 | A |
| **Activity** | **100,0 %** | ✅ | 281 / 168 / 5 risky | A |
| **Lang** | **100,0 %** | ✅ | 235 / 16 / 0 | A |
| **Tenant** | **100,0 %** | ✅ | 141 / 32 / 0 | A |
| Notify | **70,2 %** | ✅ | 452 / 361 / 4 risky | B |
| Media | **59,0 %** | ✅ | 256 / 34 / 2 risky | B |
| Job | **53,2 %** | ✅ | 261 / 83 / 0 | B |
| User | **64,5 %** | ✅ | 353 / 761 / 14 risky | B |
| Incentivi | **78,8 %** | ✅ | 58 / 143 / 0 | B |
| Progressioni | **83,5 %** | ✅ | 49 / 21 / 0 (+12 todo) | B |
| IndennitaCondizioniLavoro | **69,4 %** | ✅ | 91 / 1 / 1 risky | C |
| IndennitaResponsabilita | **83,2 %** | ✅ | 139 / 9 / 0 | C |
| Performance | **84,9 %** | ✅ | 93 / 3 / 1 risky | C |
| Ptv | **51,9 %** | ✅ | 146 / 0 / 1 risky | C |
| UI | **83,1 %** | ✅ | 198 / 112 / 1 risky | C |
| Sigma | **54,9 %** | ✅ | 83 / 2 / 1 risky | D |
| Pdnd | **68,2 %** | ✅ | 69 / 6 / 1 risky | D |
| Xot | **53,1 %** | ✅ | 301 / 237 / 5 risky | D |

### Story 5.26 — gate `--min=100` live (2026-08-20 pomeriggio)

| Modulo | Total | Gate 100% | Note |
|--------|------:|:---------:|------|
| Rating | 100,0 % | ✅ | Wave A |
| Activity | 100,0 % | ✅ | Wave A |
| Lang | 100,0 % | ✅ | ripristinato dopo race `config/com` mancante |
| Tenant | 100,0 % | ✅ | Wave A |
| UI | **92,2 %** | ❌ | suite quasi verde; IconState/Spatie/InlineDate |
| Progressioni | **93,7 %** | ❌ | CloseGaps + bugfix cast/DI; Scheda/TrovaEsclusi residui |
| Performance | **90,3 %** | ❌ | suite verde; Update* Actions residue |
| IR | **85,9 %** | ❌ | suite verde; LettI/CSV residue |
| Notify | **63,9 %** | ❌ | suite verde (golden sqlite); gap provider |
| ICL | ~70,4 % | ❌ | CondizioniLavoro / ServizioEsterno |
| **Pdnd** | **100,0 %** | ✅ | gate `--min=100` (130 pass / 6 skip) |
| Sigma | **77,4 %** | ❌ | suite verde (+12pp); SchedaMutator ancora gap |
| Media / Job / User / Xot / Ptv / Incentivi | n/a o &lt;70 | ❌ | agenti paralleli in corso |

### Story 5.26 Xot — progress (2026-08-20)

Gate `--min=100` **non ancora verde**. Live clover gate11: **69,13%** (6913/10000),
baseline story **53,16%** → **+16 pp**. Residuo ~3087 stmt. Migration uuid paths ↑.

| Artefatto test | Ruolo |
|----------------|--------|
| `XotHundredPercentCoverageTest.php` | FileAction/Datas/Security/Migration/enums/helper |
| `XotFilamentHundredCoverageTest.php` | Resource/RelationManager/traits/mixins |
| `XotCommandsActionsHundredCoverageTest.php` | Console + Actions sweep |
| `XotGapCloserHundredCoverageTest.php` | DayOfWeek/HasExtra/Generate*/zeros |
| `XotGap2HundredCoverageTest.php` | sqlite memory + top gaps + Module mock |
| `XotTimedSweepHundredCoverageTest.php` | reflect safe dirs (budget tempo) |
| `XotZeroKillerHundredCoverageTest.php` | AutoLabel + Model Update/Store |
| `XotFilamentSupportHundredCoverageTest.php` | Support ColumnBuilder |
| `XotDeepFileActionCoverageTest.php` | FileAction asset/config/copy in-process |
| `XotInProcessDeepCoverageTest.php` | Migration/FilamentOpt/Security/RelationX |
| `XotSecurityHandlersCoverageTest.php` | rate-limit + HandlersRepository |
| `XotFloor50ExtrasCoverageTest.php` | non-public invoke residue |
| `XotRelationManageStatesCoverageTest.php` | RelationX pivot stub + ManageRelated |
| `XotFieldRefreshQueryExportCoverageTest.php` | FieldRefresh + QueryExport |
| `XotMigrationDeepBranchesTest.php` | uuid→bigint / information_schema |

**Blocco verso 100%:** ~3287 stmt residui; top: `XotBaseMigration`, `FileAction`,
`XotBaseManageRelatedRecords`, `RelationX`, Filament pages/widgets Livewire.
`ModuleRemainingCoverage::testEntireAppTree` hangano — usare solo sweep mirati + File::fake.

## Contratto statico degli harness condivisi

Gli harness `FilamentSchemaCoverage`, `ModuleExecuteCoverage`,
`ModuleRemainingCoverage` e `XotForkedInvoke` sono codice canonico Xot: sono importati dai
test di più moduli e non sono output generato. Il loro contratto è quindi lo stesso del
codice applicativo: boundary espliciti, valori ottenuti via reflection ristretti prima
dell'uso e nessuna asserzione che verifichi soltanto un tipo già dichiarato.

`XotForkedInvoke::invokeWithTimeout()` restituisce `true` soltanto quando la callback termina
con successo entro il timeout. Eccezioni, fork fallito e timeout restituiscono `false`; il
processo figlio usa l'exit status per comunicare l'esito al parent. I consumer possono così
distinguere coverage realmente eseguita da un tentativo fallito.

I due test aggregatori Xot restano consumer canonici, ma non devono diventare una discarica
di chiamate “per fare righe”: ogni assert deve osservare un risultato di dominio e i catch
non contengono successi tautologici.

App fix correlati: `FileAction::getViewNameSpacePath` hint `ns.0`; `dd()` catch → `RuntimeException`;
`Generate*ByFileAction::ddFile` senza dump.

**Story 5.24 AC2: 18/18 moduli ✅** — status `review` in
[5.24](./stories/5.24.module-coverage-fifty-percent-floor.story.md).

Pattern skip offline:
[module-test-skip-offline-pattern.md](./wiki/concepts/module-test-skip-offline-pattern.md).

## Snapshot clover parallelo (2026-08-20 ~10:00, build/cov-now)

Misura concorrente (suite non necessariamente verde → clover comunque scritto).
**Rating live gate `--min=100` = 100,0% ✅** (clover sotto può essere stale).

| Modulo | Clover % | Note |
|--------|----------:|------|
| Progressioni | 72,6 | in salita |
| Rating | 71,1 clover / **100 live** | **5.26 DONE** |
| Performance | 64,8 | |
| Incentivi | 64,1 | |
| Tenant | 56,4 | |
| IndennitaCondizioniLavoro | 52,8 | |
| Job | 53,2 live | hang sweep rimosso |
| Notify | 52,5 | |
| Pdnd | 52,1 | |
| Lang | 51,3 | |
| IndennitaResponsabilita | 50,7 | |
| UI | 50,5 | |
| Media | 50,0 | |
| Xot | 44,4 | foundation |
| Ptv | 23,1 | |
| Activity / Sigma / User | TBD | run in corso |

**Blocco operativo:** ~27 processi Pest in parallelo sullo stesso `fixcity_data.sqlite`
→ `SQLITE_BUSY`. Mitigazione: skip write DB in Lang/Tenant TestCase durante campagna 5.26.



**5.26 T1 AC4 (2026-08-20):** `dddx()` attivi in `Modules/*/app` 104 → 0 (RuntimeException).

Perimetro exclude documentato: [testing-coverage-floor.md](./testing-coverage-floor.md).

## Baseline clover 2026-08-19 (storica)

Prodotta con:

```bash
XDEBUG_MODE=coverage ./vendor/bin/pest -c Modules/{Mod}/phpunit.xml \
  --coverage --coverage-clover build/coverage-baseline/clover-{Mod}.xml --min=0
```

Percentuali da `coveredstatements / statements` in `<project><metrics>`.

| Modulo | Coverage clover | Coperti | Statement | Note |
|---|---:|---:|---:|---|
| **Rating** | 70,9 % | 442 | 623 | — |
| Tenant | 34,9 % | 321 | 919 | gate live 51,7 % |
| Activity | 29,0 % | 223 | 770 | gate live 54,2 % |
| Lang | 21,3 % | 238 | 1 116 | gate live 51,7 % |
| Notify | 15,4 % | 786 | 5 101 | — |
| Media | 13,4 % | 418 | 3 130 | — |
| UI | 11,4 % | 198 | 1 740 | — |
| Job | 10,3 % | 216 | 2 091 | — |
| Performance | 5,2 % | 299 | 5 754 | — |
| IndennitaCondizioniLavoro | 3,6 % | 61 | 1 715 | — |
| IndennitaResponsabilita | 3,1 % | 84 | 2 688 | — |
| Ptv | 2,9 % | 201 | 6 980 | — |
| Sigma | 0,1 % | 7 | 5 067 | — |
| Progressioni | 0,0 % | 1 | 5 115 | — |
| Pdnd | 0,0 % | 0 | 6 327 | — |
| User | 8,8 % | 907 | 10 369 | clover post-wave0 |
| Xot | 17,4 % | 1 719 | 9 900 | clover post-wave0 |
| Incentivi | 6,2 % | 185 | 2 963 | clover post-wave0 |
| **Totale 18 moduli** | **~8,9 %** | **6 445** | **72 369** | — |

Il clover è **parziale** quando la suite è rossa: i test falliti non eseguono codice. Dopo
suite verde + test mirati, la % live supera spesso il clover (vedi Activity 29% → 54%).

## Trappole di misura, verificate

1. **Pest stampa la tabella solo su exit 0** — il clover si scrive lo stesso.
2. **`--coverage-filter` da CLI è ignorato** — vale solo `<source>` in `phpunit.xml`.
3. **Xdebug obbligatorio** (`pcov` assente): `XDEBUG_MODE=coverage`.
4. **Classi anonime** → byte NUL in path lingua → `file_put_contents` fatal. Usare sottoclassi
   nominata nel file di test.
5. **`test('…')->skip()`** → PHPStan emptyClosure; usare `todo('motivo')` o skip in `TestCase::setUp()`.
6. **Asserzione tautologica ≠ coverage.** `assertTrue(true)` / `assertIsInt()` su un `int` già noto
   alzano la coverage eseguendo il codice ma non verificano il comportamento. PHPStan li marca
   `alreadyNarrowedType`. Si sostituiscono con un valore osservabile (`assertSame(200, $export->chunkSize())`)
   o si cancella il test. Recipe e misura: [phpstan-rules.md](./quality/phpstan-rules.md).

## Tetto strutturale (schema sqlite)

`database/fixcity_data.sqlite` non contiene tabelle di dominio (`users`, `media`, `activity_log`).
Finché non c’è schema deterministico ([5.25](./stories/5.25.module-suite-green-offline.story.md)),
i moduli DB-heavy usano **skip condizionato** (pilota Activity) per suite verde offline e
misura onesta del perimetro Unit.

MySQL locale su `127.0.0.1:3306` esiste; credenziali `.env.testing` vanno verificate per la via C
(MySQL `*_test`, AD-3).
