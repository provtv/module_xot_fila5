#!/bin/bash

# Script per analisi sistematica qualità codice modulo per modulo
# Utilizza PHPStan livello 10, PHPMD e PHPInsights

set -e

MODULE_NAME="${1:-}"
LARAVEL_ROOT="/var/www/_bases/base_ptvx_fila4_mono/laravel"
MODULE_PATH="${LARAVEL_ROOT}/Modules/${MODULE_NAME}"

if [ -z "$MODULE_NAME" ]; then
    echo "Usage: $0 <ModuleName>"
    exit 1
fi

if [ ! -d "$MODULE_PATH" ]; then
    echo "❌ Module $MODULE_NAME not found at $MODULE_PATH"
    exit 1
fi

echo "=========================================="
echo "📊 Analisi Qualità: $MODULE_NAME"
echo "=========================================="
echo ""

# 1. PHPStan Level 10
echo "🔍 [1/3] PHPStan Level 10..."
cd "$LARAVEL_ROOT"
./vendor/bin/phpstan analyze "Modules/${MODULE_NAME}" --level=10 --memory-limit=2G > "/tmp/phpstan-${MODULE_NAME}.txt" 2>&1 || true
PHPSTAN_ERRORS=$(grep -c "ERROR\|Found.*error" "/tmp/phpstan-${MODULE_NAME}.txt" || echo "0")
if [ "$PHPSTAN_ERRORS" = "0" ] || grep -q "No errors" "/tmp/phpstan-${MODULE_NAME}.txt"; then
    echo "   ✅ PHPStan: 0 errori"
else
    echo "   ⚠️  PHPStan: Errori trovati (vedi /tmp/phpstan-${MODULE_NAME}.txt)"
fi

# 2. PHPMD
echo "🔍 [2/3] PHPMD..."
if [ -f "${LARAVEL_ROOT}/phpmd.xml" ]; then
    ./vendor/bin/phpmd "Modules/${MODULE_NAME}/app" text "${LARAVEL_ROOT}/phpmd.xml" > "/tmp/phpmd-${MODULE_NAME}.txt" 2>&1 || true
    PHPMD_VIOLATIONS=$(grep -c "violation" "/tmp/phpmd-${MODULE_NAME}.txt" || echo "0")
    if [ "$PHPMD_VIOLATIONS" = "0" ]; then
        echo "   ✅ PHPMD: 0 violazioni"
    else
        echo "   ⚠️  PHPMD: $PHPMD_VIOLATIONS violazioni (vedi /tmp/phpmd-${MODULE_NAME}.txt)"
    fi
else
    echo "   ⚠️  PHPMD: Configurazione non trovata"
fi

# 3. PHPInsights
echo "🔍 [3/3] PHPInsights..."
if [ -f "${MODULE_PATH}/phpinsights.php" ]; then
    ./vendor/bin/phpinsights analyse "Modules/${MODULE_NAME}" --format=json > "/tmp/phpinsights-${MODULE_NAME}.json" 2>&1 || true
    echo "   ✅ PHPInsights: Analisi completata (vedi /tmp/phpinsights-${MODULE_NAME}.json)"
else
    echo "   ⚠️  PHPInsights: Configurazione non trovata"
fi

echo ""
echo "=========================================="
echo "📝 Risultati salvati in /tmp/"
echo "=========================================="

