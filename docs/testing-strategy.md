---
title: Strategia di testing
description: Puntatore alla strategia canonica sui database di test.
module: Xot
area: testing
status: superseded
audience: [developer, ai-agent]
tags:
  - testing
  - database
related:
  - Modules/Xot/docs/testing-database-strategy.md
---

# Strategia di testing

Contenuto assorbito in [testing-database-strategy.md](./testing-database-strategy.md).

Quel documento e' la fonte unica su: repliche MySQL con suffisso `_test`, le tre connessioni
(`mysql`, `user`, `limesurvey`), il file di ambiente generato `laravel/.env.sqlite`, il
divieto di SQLite, `RefreshDatabase` e `migrate:fresh`.
