<<<<<<< HEAD
---
module: theme
topic: cleanup-empty-files
canonical: ../../../../Themes/docs/shared-components/cleanup-empty-files.sh
---

See canonical documentation: ../../../../Themes/docs/shared-components/cleanup-empty-files.sh
=======
#!/bin/bash
# cleanup-empty-files.sh
# Trova e rimuove file markdown vuoti dalle docs dei moduli

set -e

MODULE_PATH="../../.."  # Modules root
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

echo -e "${YELLOW}🔍 Cercando file markdown vuoti...${NC}"

# Trova file vuoti
EMPTY_FILES=$(find "$MODULE_PATH"/*/docs -type f -size 0 -name "*.md" 2>/dev/null || true)
COUNT=$(echo "$EMPTY_FILES" | grep -c "." || echo "0")

if [ "$COUNT" -gt 0 ]; then
    echo -e "${RED}📋 Trovati $COUNT file vuoti:${NC}"
    echo "$EMPTY_FILES" | while read file; do
        echo "  - $file"
    done
    
    echo ""
    read -p "Vuoi eliminarli? (y/n) " -n 1 -r
    echo
    if [[ $REPLY =~ ^[Yy]$ ]]; then
        find "$MODULE_PATH"/*/docs -type f -size 0 -name "*.md" -delete 2>/dev/null
        echo -e "${GREEN}✅ File eliminati${NC}"
    else
        echo -e "${YELLOW}⚠️  Operazione annullata${NC}"
    fi
else
    echo -e "${GREEN}✅ Nessun file vuoto trovato!${NC}"
fi
>>>>>>> laraxot/master
