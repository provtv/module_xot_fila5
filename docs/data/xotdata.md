---
title: XotData — path tema pub e accessor runtime
type: concept
tags: [xot, xotdata, theme, folio, pest]
updated_at: '2026-07-27'
qmd: xotdata getPubThemeViewPath realpath missing theme
---

# XotData

## Perché

DTO runtime (`Spatie Data`) per tema pubblico/admin, classi User/Profile/Team/Tenant e path asset. Unica fonte per `pub_theme` e path Blade Folio.

## `getPubThemeViewPath(string $key = '')`

- Costruisce `Themes/{pub_theme}/resources/views/{key}`.
- Se la directory **manca** (submodule incompleto, es. Meetup senza `resources/views` in test): **non lanciare** — restituisce il path non risolto.
- `Safe\realpath` solo se `is_dir`; in catch → path grezzo.
- Caller tipico: `FolioVoltServiceProvider` con `File::exists()` prima di registrare Folio.

Motivazione: bootstrap Pest/app non deve fallire per tema FO assente; Folio già gestisce path mancanti.

## Collegamenti

- [xotdata.md](../xotdata.md)
- [module-development/xotdata-theme-asset-compatibility.md](../module-development/xotdata-theme-asset-compatibility.md)
- Chat swarm: `docs/chat/phpstan-modules-swarm-session.md`
