#!/bin/bash

# Script per analisi sistematica qualità codice di tutti i moduli
# Utilizza PHPStan livello 10, PHPMD e PHPInsights

set -e

LARAVEL_ROOT="/var/www/_bases/base_ptvx_fila4_mono/laravel"
RESULTS_DIR="/tmp/module-analysis-$(date +%Y%m%d-%H%M%S)"
mkdir -p "$RESULTS_DIR"

cd "$LARAVEL_ROOT"

echo "=========================================="
echo "📊 Analisi Qualità Codice - Tutti i Moduli"
echo "=========================================="
echo "Risultati salvati in: $RESULTS_DIR"
echo ""

# Contatori
TOTAL_MODULES=0
PHPSTAN_PASS=0
PHPMD_PASS=0
PHPINSIGHTS_PASS=0

for dir in Modules/*/; do
    MODULE_NAME=$(basename "$dir")
    
    # Skip special directories
    if [ "$MODULE_NAME" = "docs" ]; then
        continue
    fi
    
    TOTAL_MODULES=$((TOTAL_MODULES + 1))
    
    echo "----------------------------------------"
    echo "📦 Modulo: $MODULE_NAME"
    echo "----------------------------------------"
    
    # 1. PHPStan Level 10
    echo -n "  🔍 PHPStan Level 10... "
    if ./vendor/bin/phpstan analyze "Modules/${MODULE_NAME}" --level=10 --memory-limit=2G > "$RESULTS_DIR/phpstan-${MODULE_NAME}.txt" 2>&1; then
        echo "✅ PASS"
        PHPSTAN_PASS=$((PHPSTAN_PASS + 1))
    else
        echo "❌ FAIL (vedi $RESULTS_DIR/phpstan-${MODULE_NAME}.txt)"
    fi
    
    # 2. PHPMD
    echo -n "  🔍 PHPMD... "
    if [ -f "phpmd.xml" ] && [ -d "Modules/${MODULE_NAME}/app" ]; then
        if ./vendor/bin/phpmd "Modules/${MODULE_NAME}/app" text phpmd.xml > "$RESULTS_DIR/phpmd-${MODULE_NAME}.txt" 2>&1; then
            echo "✅ PASS"
            PHPMD_PASS=$((PHPMD_PASS + 1))
        else
            VIOLATIONS=$(grep -c "violation" "$RESULTS_DIR/phpmd-${MODULE_NAME}.txt" 2>/dev/null || echo "0")
            if [ "$VIOLATIONS" = "0" ]; then
                echo "✅ PASS"
                PHPMD_PASS=$((PHPMD_PASS + 1))
            else
                echo "⚠️  $VIOLATIONS violazioni (vedi $RESULTS_DIR/phpmd-${MODULE_NAME}.txt)"
            fi
        fi
    else
        echo "⏭️  SKIP (no app/ directory)"
    fi
    
    # 3. PHPInsights
    echo -n "  🔍 PHPInsights... "
    if [ -f "Modules/${MODULE_NAME}/phpinsights.php" ]; then
        if ./vendor/bin/phpinsights analyse "Modules/${MODULE_NAME}" --format=json > "$RESULTS_DIR/phpinsights-${MODULE_NAME}.json" 2>&1; then
            echo "✅ PASS"
            PHPINSIGHTS_PASS=$((PHPINSIGHTS_PASS + 1))
        else
            echo "⚠️  WARNINGS (vedi $RESULTS_DIR/phpinsights-${MODULE_NAME}.json)"
        fi
    else
        echo "⏭️  SKIP (no phpinsights.php)"
    fi
    
    echo ""
done

echo "=========================================="
echo "📊 Riepilogo Finale"
echo "=========================================="
echo "Moduli analizzati: $TOTAL_MODULES"
echo "PHPStan Level 10: $PHPSTAN_PASS/$TOTAL_MODULES ✅"
echo "PHPMD: $PHPMD_PASS/$TOTAL_MODULES ✅"
echo "PHPInsights: $PHPINSIGHTS_PASS/$TOTAL_MODULES ✅"
echo ""
echo "Risultati completi in: $RESULTS_DIR"
echo "=========================================="

