<<<<<<< HEAD
---
module: theme
topic: xotbaserouteserviceprovider-resolution
canonical: ../../../Themes/docs/shared-components/xotbaserouteserviceprovider-conflict-resolution.md
---

<<<<<<< .merge_file_suvS7V
See canonical documentation: ../../../Themes/docs/shared-components/xotbaserouteserviceprovider-conflict-resolution.md
=======
# Risoluzione conflitto XotBaseRouteServiceProvider.php

## Problema
Il file conteneva marker di conflitto git  all'interno del metodo `boot()`, con possibili duplicati o codice commentato.

## Scelta
- Sono stati rimossi tutti i marker di conflitto.
- È stato mantenuto il codice più recente e coerente con la logica del modulo.
- La chiamata a `parent::boot();` viene mantenuta dopo la configurazione di `extra_conn`.
- La sintassi e lo stile PSR-12 sono stati rispettati.

## Collegamento alla doc root
Vedi `/project_docs/xot_conflict_links.md` per la mappatura dei file documentati localmente e i riferimenti incrociati.
# Risoluzione conflitto XotBaseRouteServiceProvider.php

## Problema
Il file conteneva marker di conflitto git  all'interno del metodo `boot()`, con possibili duplicati o codice commentato.

## Scelta
- Sono stati rimossi tutti i marker di conflitto.
- È stato mantenuto il codice più recente e coerente con la logica del modulo.
- La chiamata a `parent::boot();` viene mantenuta dopo la configurazione di `extra_conn`.
- La sintassi e lo stile PSR-12 sono stati rispettati.

## Collegamento alla doc root
Vedi `/docs/xot_conflict_links.md` per la mappatura dei file documentati localmente e i riferimenti incrociati.
>>>>>>> laraxot/master
=======
See canonical documentation: ../../../Themes/docs/shared-components/xotbaserouteserviceprovider-conflict-resolution.md
>>>>>>> .merge_file_OFFWUf
