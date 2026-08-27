<<<<<<< HEAD
---
module: theme
topic: composer-resolution
canonical: ../../../Themes/docs/shared-components/composer-conflict-resolution.md
---

<<<<<<< .merge_file_0EdR7w
See canonical documentation: ../../../Themes/docs/shared-components/composer-conflict-resolution.md
=======
# Risoluzione conflitti Composer (Xot)

## Scopo
- Garantire coerenza delle dipendenze del modulo Xot e dell’ecosistema Filament/Livewire.

## Decisioni
- Allineamento di `filament/filament` a `^5.0`.
- Allineamento di `livewire/livewire` a `^4.0` per compatibilità con Filament v5.
- Rimozione di `pestphp/pest-plugin-livewire` se il progetto resta su PHP `^8.2`, perché le versioni 4.x richiedono PHP `^8.3` e Livewire `^4.0.1`.

## Collegamenti
- [Gestione dipendenze Composer](../../../../docs/composer.md)
>>>>>>> laraxot/master
=======
See canonical documentation: ../../../Themes/docs/shared-components/composer-conflict-resolution.md
>>>>>>> .merge_file_juBv1Z
