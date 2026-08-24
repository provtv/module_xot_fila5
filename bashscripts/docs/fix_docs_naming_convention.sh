#!/bin/bash

# Fix all docs naming conventions - lowercase only (except README.md)
# Following Laraxot PTVX naming conventions

set -euo pipefail

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
PROJECT_ROOT="$(cd "$SCRIPT_DIR/../../../.." && pwd)"

echo "🔧 Fixing docs naming conventions - lowercase only (except README.md)..."

# Function to rename files and directories to lowercase
fix_naming_in_module() {
    local module_name="$1"
    local docs_dir="$PROJECT_ROOT/Modules/$module_name/docs"
    
    if [[ ! -d "$docs_dir" ]]; then
        return 0
    fi
    
    echo "📁 Processing $module_name module docs..."
    
    # Find and rename directories first (depth-first)
    find "$docs_dir" -depth -type d | while read -r dir; do
        local dirname=$(basename "$dir")
        local parent_dir=$(dirname "$dir")
        
        # Skip if already lowercase or is root docs dir
        if [[ "$dirname" == "docs" ]] || [[ "$dirname" == "${dirname,,}" ]]; then
            continue
        fi
        
        local new_name="${dirname,,}"
        local new_path="$parent_dir/$new_name"
        
        if [[ "$dir" != "$new_path" ]]; then
            echo "  📂 Renaming directory: $dirname → $new_name"
            mv "$dir" "$new_path"
        fi
    done
    
    # Find and rename files
    find "$docs_dir" -type f -name "*.md" | while read -r file; do
        local filename=$(basename "$file")
        local dir_path=$(dirname "$file")
        
        # Skip README.md (only exception allowed)
        if [[ "$filename" == "README.md" ]]; then
            continue
        fi
        
        # Convert to lowercase
        local new_filename="${filename,,}"
        local new_path="$dir_path/$new_filename"
        
        if [[ "$file" != "$new_path" ]]; then
            echo "  📄 Renaming file: $filename → $new_filename"
            mv "$file" "$new_path"
        fi
    done
    
    # Fix any other non-md files
    find "$docs_dir" -type f ! -name "*.md" | while read -r file; do
        local filename=$(basename "$file")
        local dir_path=$(dirname "$file")
        
        # Convert to lowercase
        local new_filename="${filename,,}"
        local new_path="$dir_path/$new_filename"
        
        if [[ "$file" != "$new_path" ]]; then
            echo "  📄 Renaming file: $filename → $new_filename"
            mv "$file" "$new_path"
        fi
    done
}

# Process all modules
echo "🎯 Processing all modules for naming convention fixes..."

for module_dir in "$PROJECT_ROOT/Modules"/*; do
    if [[ -d "$module_dir" ]]; then
        module_name=$(basename "$module_dir")
        fix_naming_in_module "$module_name"
    fi
done

echo ""
echo "✅ Docs naming convention fixes completed!"
echo "📋 All files and directories now use lowercase (except README.md)"

# Validation check
echo ""
echo "🔍 Validation check for remaining uppercase violations..."
violations_found=0

for module_dir in "$PROJECT_ROOT/Modules"/*; do
    if [[ -d "$module_dir/docs" ]]; then
        module_name=$(basename "$module_dir")
        
        # Check for uppercase files (excluding README.md)
        while IFS= read -r -d '' file; do
            filename=$(basename "$file")
            if [[ "$filename" != "README.md" ]] && [[ "$filename" != "${filename,,}" ]]; then
                echo "❌ Uppercase violation in $module_name: $filename"
                ((violations_found++))
            fi
        done < <(find "$module_dir/docs" -type f -print0 2>/dev/null)
        
        # Check for uppercase directories
        while IFS= read -r -d '' dir; do
            dirname=$(basename "$dir")
            if [[ "$dirname" != "docs" ]] && [[ "$dirname" != "${dirname,,}" ]]; then
                echo "❌ Uppercase directory violation in $module_name: $dirname"
                ((violations_found++))
            fi
        done < <(find "$module_dir/docs" -type d -print0 2>/dev/null)
    fi
done

if [[ $violations_found -eq 0 ]]; then
    echo "🎉 No naming convention violations found!"
else
    echo "⚠️  Found $violations_found naming violations"
fi
