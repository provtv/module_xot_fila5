#!/bin/bash

# Remove all backup directories created during docs refactoring
# Following user request to eliminate backup directories

set -euo pipefail

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
PROJECT_ROOT="$(cd "$SCRIPT_DIR/../../../.." && pwd)"

echo "🗑️  Removing all backup directories created during docs refactoring..."

# Find and remove all backup directories
find "$PROJECT_ROOT/Modules" -type d -name "docs.backup.*" -exec rm -rf {} + 2>/dev/null || true

echo "✅ All backup directories removed"

# Verify cleanup
remaining_backups=$(find "$PROJECT_ROOT/Modules" -type d -name "docs.backup.*" | wc -l)
echo "📊 Remaining backup directories: $remaining_backups"

if [[ $remaining_backups -eq 0 ]]; then
    echo "🎉 Cleanup completed successfully - no backup directories remain"
else
    echo "⚠️  Some backup directories may still exist"
    find "$PROJECT_ROOT/Modules" -type d -name "docs.backup.*"
fi
