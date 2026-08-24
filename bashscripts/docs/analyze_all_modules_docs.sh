#!/bin/bash

# Analyze all module docs for refactoring opportunities
# Following DRY + KISS + SOLID + Laraxot principles

set -euo pipefail

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
PROJECT_ROOT="$(cd "$SCRIPT_DIR/../../../.." && pwd)"

echo "📊 Analyzing all module docs for refactoring opportunities..."

# Create analysis output
ANALYSIS_DIR="$PROJECT_ROOT/docs/analysis"
mkdir -p "$ANALYSIS_DIR"

# Function to count files in a docs directory
count_docs_files() {
    local docs_dir="$1"
    if [[ -d "$docs_dir" ]]; then
        find "$docs_dir" -name "*.md" | wc -l
    else
        echo "0"
    fi
}

# Function to identify duplicate patterns
find_duplicate_patterns() {
    local docs_dir="$1"
    if [[ -d "$docs_dir" ]]; then
        # Look for files with similar names (dash vs underscore)
        find "$docs_dir" -name "*.md" | sed 's/.*\///' | sort | uniq -d
    fi
}

echo "🔍 Scanning all modules for documentation..."

{
    echo "# Module Documentation Analysis Report"
    echo "Generated: $(date)"
    echo ""
    echo "## Modules with Excessive Documentation (Candidates for Refactoring)"
    echo ""
    echo "| Module | Files | Status | Priority |"
    echo "|--------|-------|--------|----------|"
    
    # Scan all modules
    for module_dir in "$PROJECT_ROOT/Modules"/*; do
        if [[ -d "$module_dir" ]]; then
            module_name=$(basename "$module_dir")
            docs_dir="$module_dir/docs"
            
            if [[ -d "$docs_dir" ]]; then
                file_count=$(count_docs_files "$docs_dir")
                
                # Determine priority based on file count and patterns
                priority="Low"
                status="OK"
                
                if [[ $file_count -gt 50 ]]; then
                    priority="High"
                    status="NEEDS REFACTORING"
                elif [[ $file_count -gt 20 ]]; then
                    priority="Medium"
                    status="Consider refactoring"
                elif [[ $file_count -gt 10 ]]; then
                    priority="Low"
                    status="Monitor"
                fi
                
                # Check for duplicate patterns
                duplicates=$(find_duplicate_patterns "$docs_dir")
                if [[ -n "$duplicates" ]]; then
                    status="$status (duplicates found)"
                    if [[ "$priority" == "Low" ]]; then
                        priority="Medium"
                    fi
                fi
                
                echo "| $module_name | $file_count | $status | $priority |"
            fi
        fi
    done
    
    echo ""
    echo "## Detailed Analysis"
    echo ""
    
    # Detailed analysis for high-priority modules
    for module_dir in "$PROJECT_ROOT/Modules"/*; do
        if [[ -d "$module_dir" ]]; then
            module_name=$(basename "$module_dir")
            docs_dir="$module_dir/docs"
            
            if [[ -d "$docs_dir" ]]; then
                file_count=$(count_docs_files "$docs_dir")
                
                if [[ $file_count -gt 20 ]]; then
                    echo "### $module_name Module ($file_count files)"
                    echo ""
                    echo "**Structure:**"
                    find "$docs_dir" -type d | head -10 | while read -r dir; do
                        rel_path=${dir#$docs_dir/}
                        if [[ "$rel_path" != "$docs_dir" ]]; then
                            echo "- $rel_path/"
                        fi
                    done
                    
                    echo ""
                    echo "**Common file patterns:**"
                    find "$docs_dir" -name "*.md" | sed 's/.*\///' | sort | head -10 | while read -r file; do
                        echo "- $file"
                    done
                    
                    echo ""
                    echo "**Potential duplicates:**"
                    # Look for dash/underscore variants
                    find "$docs_dir" -name "*-*" | while read -r dash_file; do
                        base_name=$(basename "$dash_file" .md)
                        underscore_name=${base_name//-/_}
                        underscore_file="$(dirname "$dash_file")/${underscore_name}.md"
                        if [[ -f "$underscore_file" ]]; then
                            echo "- $(basename "$dash_file") ↔ $(basename "$underscore_file")"
                        fi
                    done
                    
                    echo ""
                fi
            fi
        fi
    done
    
    echo "## Recommendations"
    echo ""
    echo "### High Priority Modules (>50 files)"
    echo "These modules should be refactored immediately following the Lang module pattern:"
    
    for module_dir in "$PROJECT_ROOT/Modules"/*; do
        if [[ -d "$module_dir" ]]; then
            module_name=$(basename "$module_dir")
            docs_dir="$module_dir/docs"
            
            if [[ -d "$docs_dir" ]]; then
                file_count=$(count_docs_files "$docs_dir")
                if [[ $file_count -gt 50 ]]; then
                    echo "- **$module_name** ($file_count files) - Apply DRY + KISS + SOLID refactoring"
                fi
            fi
        fi
    done
    
    echo ""
    echo "### Medium Priority Modules (20-50 files)"
    echo "These modules should be reviewed and potentially refactored:"
    
    for module_dir in "$PROJECT_ROOT/Modules"/*; do
        if [[ -d "$module_dir" ]]; then
            module_name=$(basename "$module_dir")
            docs_dir="$module_dir/docs"
            
            if [[ -d "$docs_dir" ]]; then
                file_count=$(count_docs_files "$docs_dir")
                if [[ $file_count -gt 20 && $file_count -le 50 ]]; then
                    echo "- **$module_name** ($file_count files) - Review for consolidation opportunities"
                fi
            fi
        fi
    done
    
    echo ""
    echo "## Refactoring Pattern (Based on Lang Module Success)"
    echo ""
    echo "1. **Backup existing docs** - Create timestamped backup"
    echo "2. **Identify core topics** - Focus on business logic"
    echo "3. **Consolidate duplicates** - Eliminate dash/underscore variants"
    echo "4. **Create essential structure** - 8-12 core files maximum"
    echo "5. **Apply SOLID principles** - Clear separation of concerns"
    echo "6. **Focus on business logic** - Remove redundant technical details"
    echo ""
    echo "**Target structure for each module:**"
    echo "- README.md (Navigation and quick reference)"
    echo "- core-functionality.md (Main business logic)"
    echo "- integration.md (Framework integrations)"
    echo "- configuration.md (Setup and configuration)"
    echo "- migration-patterns.md (Database patterns)"
    echo "- troubleshooting.md (Common issues)"
    echo "- phpstan-compliance.md (Code quality)"
    echo "- best-practices.md (Guidelines)"
    
} > "$ANALYSIS_DIR/modules_docs_analysis.md"

echo "✅ Analysis complete!"
echo "📄 Report generated: $ANALYSIS_DIR/modules_docs_analysis.md"
echo ""
echo "📊 Summary of findings:"
echo "High priority modules (>50 files):"
for module_dir in "$PROJECT_ROOT/Modules"/*; do
    if [[ -d "$module_dir" ]]; then
        module_name=$(basename "$module_dir")
        docs_dir="$module_dir/docs"
        if [[ -d "$docs_dir" ]]; then
            file_count=$(count_docs_files "$docs_dir")
            if [[ $file_count -gt 50 ]]; then
                echo "  - $module_name: $file_count files"
            fi
        fi
    fi
done
