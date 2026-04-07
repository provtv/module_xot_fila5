# 📚 Xot Module - Documentation Index

**Path**: `Modules/Xot/docs/`
**Modulo**: @Modules/Xot
**Last Updated**: 2026-03-26
**Status**: ✅ COMPLETE

---

## 🎯 Scopo

Documentazione completa per il modulo **Xot** - Core architecture del progetto Laraxot.

**Visione**: Fornire le fondamenta architetturali per tutti i moduli (Predict, Blog, User, etc.).

---

## Roadmap

- [Roadmap Xot](roadmap/00-index.md) - Visione, fasi, qualità

---

## 📦 Struttura

```
docs/
├── 00-index.md                    ← Questo file
├── README.md                      ← Panoramica modulo
├── ARCHITECTURE.md                ← Architettura tecnica
├── XOTBASE_ARCHITECTURE_PHILOSOPHY.md ← Filosofia XotBase (CRITICAL!)
│
├── 01-architecture/
│   ├── 00-index.md
│   ├── base-class-hierarchy.md
│   └── traits-composable-pattern.md
│
├── 02-filament/
│   ├── 00-index.md
│   ├── xotbase-table-widget.md
│   ├── xotbase-widget.md
│   └── xotbase-resource.md
│
└── 03-traits/
    ├── 00-index.md
    ├── HasXotTable.md
    └── TransTrait.md
```

---

## 📚 Documentation Sections

### Core Architecture
- [XotBase Classes & Inheritance Patterns](./xotbase-extension.md)
- [Service Provider Architecture](./service-provider-architecture.md)
- [Module Dependency Management](./composer-module-dependency-management.md)
- [Composer Packages Reference](../../../../docs/composer-packages-reference.md) - Mappatura pacchetti per modulo
- [Inventario completo 312 pacchetti](../../../../docs/architecture/composer-packages-full-inventory.md) - Tutti i pacchetti con versione e descrizione
- [Composer Packages Deep Study (2026-03-02)](./composer-packages-deep-study-2026-03-02.md)
- [Composer Packages Full Catalog (2026-03-02)](./composer-packages-full-catalog-2026-03-02.md) - Studio completo package-by-package da `composer show`
- [Database Connection Configuration](./database-configuration-critical-rules.md)

### Development Standards
- [PHPStan Level 10 Compliance Guide](./phpstan-level10.md)
- [Code Quality Workflow](./code-quality-tools-guide.md)
- [TDD Laravel Pest Complete Guide](./tdd-laravel-pestd-complete-guide.md) ⭐ NEW
- [Testing Best Practices](./testing-best-practices.md)

### Memory & Performance
- [Filament Memory Optimization](./memory-optimization.md)
- [Optimize Filament Memory Command](./memory-optimization-dashboard-fixes.md)
- [Performance Analysis Guide](./performance-guidelines.md)

### Filament
- [HasXotForm form() DEVE essere final](./hasxotform-form-final.md) — Regola: form() final, usare getFormSchema()

### PHPStan
- [phpstan.neon immutabile](./phpstan-neon-immutable.md) — laravel/phpstan.neon è l'unico config, NON modificare, NON creare altri

### Error Prevention & Fixes
- [Common PHPStan Errors & Solutions](./analisi-phpstan.md)
- [Model Casting Migration Guide](./model-casting-rules.md)
- [Git Conflict Resolution Workflow](./git-conflicts-resolution-strategy.md)
- [Chaos Monkey Operability Rules](./chaos-monkey-operability-rules.md)

### Utilities & Helpers
- [Safe Cast Actions](./safe-casting-actions.md)
- [Translation Management](./translation-system-standardization.md)

---

## 📄 Documenti Principali

### Architettura
| File | Descrizione | Link |
|------|-------------|------|
| XOTBASE_ARCHITECTURE_PHILOSOPHY.md | **FILOSOFIA PROFONDA**: Perché estendere XotBase | [Link](./XOTBASE_ARCHITECTURE_PHILOSOPHY.md) |
| ARCHITECTURE.md | Architettura tecnica del modulo | [Link](./ARCHITECTURE.md) |

### XotBase Rules (CRITICAL!)
| File | Descrizione | Link |
|------|-------------|------|
| XotBase NO table() Method | CHI ESTENDE XotBaseTableWidget NON DEVE AVERE table() | [Link](../../.qwen/rules/xotbase-no-table-method.mdc) |
| XotBase Architecture | Tutti i widget DEVONO estendere XotBase | [Link](../../.qwen/rules/xotbase-architecture.mdc) |

### Filament Widgets
| File | Descrizione | Link |
|------|-------------|------|
| XotBaseTableWidget | Table widget base per TUTTI i moduli | [Source](../app/Filament/Widgets/XotBaseTableWidget.php) |
| XotBaseWidget | Widget base per tutti i moduli | [Source](../app/Filament/Widgets/XotBaseWidget.php) |

### Traits
| File | Descrizione | Link |
|------|-------------|------|
| HasXotTable | Trait per tabelle Laraxot | [Source](../Filament/Traits/HasXotTable.php) |
| TransTrait | Trait per i18n | [Source](../Filament/Traits/TransTrait.php) |

---

## 🔗 Link Bidirezionali

### Dal Modulo Xot verso Esterno

| Da | A | Tipo |
|----|---|------|
| Xot Module | [Predict Module](../../Modules/Predict/docs/00-index.md) | Consumer |
| Xot Module | [Blog Module](../../Modules/Blog/docs/00-index.md) | Consumer |
| Xot Module | [User Module](../../Modules/User/docs/00-index.md) | Consumer |
| Xot Module | [Theme TwentyOne](../../Themes/TwentyOne/docs/00-index.md) | Integration |

### Dall'Esterno verso Xot Module

| Da | A | Tipo |
|----|---|------|
| [Predict Module Index](../../Modules/Predict/docs/00-index.md) | XotBase Philosophy | Dependency |
| [Architecture Index](../../Modules/Predict/docs/01-architecture/00-index.md) | XotBase Architecture | Reference |
| [Filament Widgets Rule](../../docs/project/FILAMENT_WIDGETS_FOR_LISTS_RULE.md) | XotBaseTableWidget | Implementation |
| [AGENTS.md](../../AGENTS.md) | XotBase Philosophy | Critical Rule |
| [QWEN.md](../../QWEN.md) | XotBase Philosophy | Critical Rule |

---

## 🧘 XotBase Philosophy (CRITICAL!)

### Il Pattern

```
Filament\Widgets\TableWidget (Vendor)
    ↑
Modules\Xot\Filament\Widgets\XotBaseTableWidget (Laraxot)
    ↑
Modules\Predict\Filament\Widgets\OutcomesTableWidget (Business Logic)
```

### Perché Estendere XotBaseTableWidget?

1. **DRY** (Don't Repeat Yourself)
   - Codice scritto UNA volta, ereditato ovunque
   - Modifichi XotBase → tutti i widget aggiornati

2. **KISS** (Keep It Simple, Stupid)
   - API semplice, chiara, consistente
   - Nuovo developer capisce subito pattern

3. **Zen** (Composable Architecture)
   - Traits come mattoncini LEGO
   - XotBase "vuoto" → riempibile con business logic

4. **Technical Excellence**
   - Livewire keys gestite centralmente (PREVIENE BUG!)
   - Filters integration standardizzata
   - i18n con TransTrait

### I 10 Comandamenti

1. ✅ Thou shalt extend XotBase
2. ✅ Thou shalt NOT duplicate
3. ✅ Thou shalt use traits
4. ✅ Thou shalt implement getTableQuery
5. ✅ Thou shalt implement getTableColumns
6. ✅ Thou shalt respect Livewire keys
7. ✅ Thou shalt type hint
8. ✅ Thou shalt use i18n
9. ✅ Thou shalt document
10. ✅ Thou shalt test

**Documentazione Completa**: [XOTBASE_ARCHITECTURE_PHILOSOPHY.md](./XOTBASE_ARCHITECTURE_PHILOSOPHY.md)

---

## 🎯 Quick Start

### Per Sviluppatori

```bash
# 1. Leggi la filosofia
cat Modules/Xot/docs/XOTBASE_ARCHITECTURE_PHILOSOPHY.md

# 2. Studia XotBaseTableWidget
cat Modules/Xot/app/Filament/Widgets/XotBaseTableWidget.php

# 3. Vedi esempio Predict
cat Modules/Predict/Filament/Widgets/OutcomesTableWidget.php

# 4. Crea il tuo widget
php artisan make:filament-widget MyWidget
# Poi: class MyWidget extends XotBaseTableWidget
```

### Per AI Agents

1. **Prima di creare widget**: Leggi [XOTBASE_ARCHITECTURE_PHILOSOPHY.md](./XOTBASE_ARCHITECTURE_PHILOSOPHY.md)
2. **Controlla source**: [XotBaseTableWidget.php](../app/Filament/Widgets/XotBaseTableWidget.php)
3. **Vedi esempi**: [OutcomesTableWidget.php](../../Modules/Predict/Filament/Widgets/OutcomesTableWidget.php)
4. **Rules**: [.qwen/rules/](../../.qwen/rules/)

---

## 📖 Recently Updated

- ✅ **2026-02-23**: Added complete TDD guide with Pest integration
- ✅ **2026-02-23**: Updated OAuth testing patterns
- ✅ **2026-02-23**: Added QueueableAction testing standards

---

## 📊 Stato Documentazione

| Categoria | Completeness | Last Review |
|-----------|-------------|-------------|
| Philosophy | ✅ 100% | 2026-03-26 |
| Architecture | ✅ 100% | 2026-03-26 |
| Filament Widgets | 🔄 80% | 2026-03-26 |
| Traits | 🔄 70% | 2026-03-26 |
| Testing | ⏳ 40% | TODO |

---

## 🎓 Learning Resources

### Esempi nei Moduli
- [Predict Module Widgets](../../Modules/Predict/Filament/Widgets/)
- [Blog Module Widgets](../../Modules/Blog/Filament/Widgets/)
- [User Module Widgets](../../Modules/User/Filament/Widgets/)

### Documentazione Esterna
- [Filament Docs](https://filamentphp.com/docs)
- [Livewire Docs](https://livewire.laravel.com/docs)
- [Laravel Docs](https://laravel.com/docs)

---

## 🔗 Related Modules

- [User Module](../../User/docs/00-index.md) - Authentication & Authorization
- [Activity Module](../../Activity/docs/00-index.md) - Event logging & tracking
- [Tenant Module](../../Tenant/docs/00-index.md) - Multi-tenant isolation

---

## 🔗 Navigation

### Indici Correlati
- [Main Project Index](../../.agents/docs/00-index.md)
- [Predict Module Index](../../Modules/Predict/docs/00-index.md)
- [Project Docs Index](../../docs/project/00-index.md)

### Prossimi Documenti
- [XOTBASE_ARCHITECTURE_PHILOSOPHY.md](./XOTBASE_ARCHITECTURE_PHILOSOPHY.md) - Filosofia
- [ARCHITECTURE.md](./ARCHITECTURE.md) - Architettura tecnica
- [Filament Index](./02-filament/00-index.md) - Filament widgets

---

**Module Version**: 1.0
**Laravel Version**: 12.x
**Filament Version**: 5.x
**Livewire Version**: 4.x
**PHP Version**: 8.3
**Last Updated**: 2026-03-28

---

**Maintained By**: AI Agents Team
**Review Cycle**: Every sprint
**Next Review**: 2026-04-02
**Perfection Goal**: 🎯 100% complete, 0% redundancy

## Dependency Intelligence

- [Dependency intelligence](dependency-intelligence.md)
