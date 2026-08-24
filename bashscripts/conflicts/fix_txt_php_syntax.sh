#!/bin/bash

# Fix txt.php syntax errors and merge conflicts
# Following Laraxot conventions with proper array syntax

set -euo pipefail

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
PROJECT_ROOT="$(cd "$SCRIPT_DIR/../../../.." && pwd)"
TXT_FILE="$PROJECT_ROOT/Modules/Lang/lang/it/txt.php"

echo "🔧 Fixing txt.php syntax errors and merge conflicts..."

# Create backup
cp "$TXT_FILE" "${TXT_FILE}.backup"

# Create clean txt.php with proper structure
cat > "$TXT_FILE" << 'EOF'
<?php

declare(strict_types=1);

return [
    'fields' => [
        // Authentication fields
        'email' => [
            'label' => 'Email',
            'placeholder' => 'Inserisci la tua email',
            'helper_text' => 'Usa un indirizzo email valido',
        ],
        'password' => [
            'label' => 'Password',
            'placeholder' => 'Inserisci la tua password',
            'helper_text' => 'La password deve contenere almeno 8 caratteri',
        ],
        'remember' => [
            'label' => 'Ricordami',
            'placeholder' => 'Mantieni l\'accesso attivo',
            'helper_text' => 'Ricorda le credenziali su questo dispositivo',
        ],
        
        // Filter and display fields
        'applyFilters' => [
            'label' => 'Applica Filtri',
            'placeholder' => 'Applica i filtri selezionati',
            'helper_text' => 'Filtra i risultati secondo i criteri',
        ],
        'toggleColumns' => [
            'label' => 'Mostra/Nascondi Colonne',
            'placeholder' => 'Gestisci visibilità colonne',
            'helper_text' => 'Personalizza le colonne visualizzate',
        ],
        'reorderRecords' => [
            'label' => 'Riordina Records',
            'placeholder' => 'Modifica ordine elementi',
            'helper_text' => 'Trascina per riordinare',
        ],
        'resetFilters' => [
            'label' => 'Reset Filtri',
            'placeholder' => 'Ripristina filtri predefiniti',
            'helper_text' => 'Rimuovi tutti i filtri applicati',
        ],
        'openFilters' => [
            'label' => 'Apri Filtri',
            'placeholder' => 'Mostra pannello filtri',
            'helper_text' => 'Visualizza opzioni di filtro',
        ],
        
        // Generic fields
        'value' => [
            'label' => 'Valore',
            'placeholder' => 'Inserisci il valore',
            'helper_text' => 'Valore del campo',
        ],
        'values-list' => [
            'label' => 'Lista Valori',
            'placeholder' => 'Inserisci lista valori',
            'helper_text' => 'Elenco dei valori disponibili',
        ],
        'user_id' => [
            'label' => 'ID Utente',
            'placeholder' => 'Seleziona utente',
            'helper_text' => 'Identificativo dell\'utente',
        ],
        'name' => [
            'label' => 'Nome',
            'placeholder' => 'Inserisci il nome',
            'helper_text' => 'Nome dell\'elemento',
        ],
        'slug' => [
            'label' => 'Slug',
            'placeholder' => 'Inserisci lo slug',
            'helper_text' => 'Identificatore URL-friendly',
        ],
        'category_id' => [
            'label' => 'Categoria',
            'placeholder' => 'Seleziona categoria',
            'helper_text' => 'Categoria di appartenenza',
        ],
        'description' => [
            'label' => 'Descrizione',
            'placeholder' => 'Inserisci descrizione',
            'helper_text' => 'Descrizione dettagliata',
        ],
        'details' => [
            'label' => 'Dettagli',
            'placeholder' => 'Inserisci dettagli',
            'helper_text' => 'Informazioni aggiuntive',
        ],
        'is_active' => [
            'label' => 'Attivo',
            'placeholder' => 'Seleziona stato',
            'helper_text' => 'Stato di attivazione',
        ],
        'ordering' => [
            'label' => 'Ordine',
            'placeholder' => 'Inserisci ordine',
            'helper_text' => 'Posizione nell\'ordinamento',
        ],
        'start_date' => [
            'label' => 'Data Inizio',
            'placeholder' => 'Seleziona data inizio',
            'helper_text' => 'Data di inizio del periodo',
        ],
        'end_date' => [
            'label' => 'Data Fine',
            'placeholder' => 'Seleziona data fine',
            'helper_text' => 'Data di fine del periodo',
        ],
        'test_date' => [
            'label' => 'Data Test',
            'placeholder' => 'Seleziona data test',
            'helper_text' => 'Data per il test del sistema',
        ],
        'test' => [
            'label' => 'Test',
            'placeholder' => 'Inserisci valore test',
            'helper_text' => 'Campo per test del sistema',
        ],
    ],
    
    'actions' => [
        'authenticate' => [
            'label' => 'Autentica',
            'success' => 'Autenticazione completata',
            'error' => 'Errore durante l\'autenticazione',
        ],
        'login' => [
            'label' => 'Accedi',
            'success' => 'Accesso effettuato con successo',
            'error' => 'Credenziali non valide',
        ],
        'request' => [
            'label' => 'Richiedi',
            'success' => 'Richiesta inviata',
            'error' => 'Errore nell\'invio della richiesta',
        ],
        'cancel' => [
            'label' => 'Annulla',
            'success' => 'Operazione annullata',
            'error' => 'Impossibile annullare',
        ],
        'save' => [
            'label' => 'Salva',
            'success' => 'Salvato con successo',
            'error' => 'Errore durante il salvataggio',
        ],
        'activeLocale' => [
            'label' => 'Lingua Attiva',
            'success' => 'Lingua cambiata',
            'error' => 'Errore nel cambio lingua',
        ],
        'open' => [
            'label' => 'Apri',
            'success' => 'Elemento aperto',
            'error' => 'Impossibile aprire',
        ],
        'create' => [
            'label' => 'Crea',
            'success' => 'Elemento creato',
            'error' => 'Errore durante la creazione',
        ],
        'createAnother' => [
            'label' => 'Crea Altro',
            'success' => 'Nuovo elemento creato',
            'error' => 'Errore nella creazione',
        ],
    ],
];
EOF

echo "✅ txt.php syntax fixed and cleaned"

# Validate syntax
php -l "$TXT_FILE"
echo "✅ Syntax validation passed"
