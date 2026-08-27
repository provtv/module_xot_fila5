<<<<<<< HEAD
---
module: theme
topic: cleanup-empty-files-auto
canonical: ../../../../Themes/docs/shared-components/cleanup-empty-files-auto.sh
---

<<<<<<< .merge_file_aYek70
See canonical documentation: ../../../../Themes/docs/shared-components/cleanup-empty-files-auto.sh
=======
#!/bin/bash
# cleanup-empty-files-auto.sh
# Rimuove automaticamente file markdown vuoti (NO prompt)

set -e

MODULE_PATH="../../.."
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m'

echo -e "${YELLOW}🔍 Cercando file markdown vuoti...${NC}"

# Trova file vuoti
EMPTY_FILES=$(find "$MODULE_PATH"/*/docs -type f -size 0 -name "*.md" 2>/dev/null || true)
COUNT=$(echo "$EMPTY_FILES" | grep -c "." || echo "0")

if [ "$COUNT" -gt 0 ]; then
    echo -e "${RED}📋 Trovati $COUNT file vuoti${NC}"
    echo "$EMPTY_FILES" | head -20 | while read file; do
        echo "  - $file"
    done
    
    if [ "$COUNT" -gt 20 ]; then
        echo "  ... e altri $((COUNT - 20)) file"
    fi
    
    echo ""
    echo -e "${YELLOW}⚙️  Eliminazione automatica in corso...${NC}"
    
    find "$MODULE_PATH"/*/docs -type f -size 0 -name "*.md" -delete 2>/dev/null
    
    echo -e "${GREEN}✅ $COUNT file eliminati con successo${NC}"
else
    echo -e "${GREEN}✅ Nessun file vuoto trovato!${NC}"
fi
>>>>>>> laraxot/master
=======
See canonical documentation: ../../../../Themes/docs/shared-components/cleanup-empty-files-auto.sh
>>>>>>> .merge_file_k4HpYH
