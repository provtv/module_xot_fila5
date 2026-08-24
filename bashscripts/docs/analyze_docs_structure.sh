#!/bin/bash

# Analyze docs structure for DRY + KISS + SOLID refactoring
# Following memory: bash scripts must be categorized into subfolders

set -euo pipefail

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
PROJECT_ROOT="$(cd "$SCRIPT_DIR/../../../.." && pwd)"

echo "📊 Analyzing docs structure for DRY + KISS + SOLID refactoring..."

# Create analysis output directory
ANALYSIS_DIR="$PROJECT_ROOT/docs/analysis"
mkdir -p "$ANALYSIS_DIR"

# Function to analyze file content and identify duplicates
analyze_content() {
    local file="$1"
    local content_hash=$(md5sum "$file" | cut -d' ' -f1)
    echo "$content_hash:$file"
}

# Function to find similar content
find_similar_content() {
    local pattern="$1"
    local search_dir="$2"
    echo "Searching for pattern '$pattern' in $search_dir"
    find "$search_dir" -name "*.md" -exec grep -l "$pattern" {} \; 2>/dev/null || true
}

echo "🔍 Finding documentation directories..."
find "$PROJECT_ROOT" -type d -name "docs" > "$ANALYSIS_DIR/docs_directories.txt"
find "$PROJECT_ROOT" -type d -name "_docs" >> "$ANALYSIS_DIR/docs_directories.txt"

echo "📁 Found $(wc -l < "$ANALYSIS_DIR/docs_directories.txt") documentation directories"

echo "🔍 Analyzing content patterns..."

# Common documentation patterns to identify
patterns=(
    "# README"
    "## Installation"
    "## Usage"
    "## Configuration"
    "PHPStan"
    "Filament"
    "Migration"
    "Translation"
    "Best Practices"
    "Troubleshooting"
)

# Analyze each pattern
for pattern in "${patterns[@]}"; do
    echo "Analyzing pattern: $pattern"
    {
        echo "=== Pattern: $pattern ==="
        while IFS= read -r docs_dir; do
            if [[ -d "$docs_dir" ]]; then
                find_similar_content "$pattern" "$docs_dir"
            fi
        done < "$ANALYSIS_DIR/docs_directories.txt"
        echo ""
    } >> "$ANALYSIS_DIR/content_patterns.txt"
done

echo "🔍 Finding duplicate files by content..."
{
    echo "=== Duplicate Content Analysis ==="
    while IFS= read -r docs_dir; do
        if [[ -d "$docs_dir" ]]; then
            find "$docs_dir" -name "*.md" -exec bash -c 'analyze_content "$0"' {} \;
        fi
    done < "$ANALYSIS_DIR/docs_directories.txt"
} | sort > "$ANALYSIS_DIR/file_hashes.txt"

# Find actual duplicates
awk -F: '{print $1}' "$ANALYSIS_DIR/file_hashes.txt" | sort | uniq -d > "$ANALYSIS_DIR/duplicate_hashes.txt"

{
    echo "=== Files with Duplicate Content ==="
    while IFS= read -r hash; do
        echo "Hash: $hash"
        grep "^$hash:" "$ANALYSIS_DIR/file_hashes.txt" | cut -d: -f2-
        echo ""
    done < "$ANALYSIS_DIR/duplicate_hashes.txt"
} > "$ANALYSIS_DIR/duplicate_files.txt"

echo "📊 Generating structure report..."
{
    echo "# Documentation Structure Analysis Report"
    echo "Generated: $(date)"
    echo ""
    echo "## Summary"
    echo "- Total docs directories: $(wc -l < "$ANALYSIS_DIR/docs_directories.txt")"
    echo "- Total markdown files: $(find "$PROJECT_ROOT" -name "*.md" | wc -l)"
    echo "- Duplicate content groups: $(wc -l < "$ANALYSIS_DIR/duplicate_hashes.txt")"
    echo ""
    echo "## Issues Identified"
    echo ""
    echo "### 1. Multiple docs directories per module"
    echo "Some modules have both 'docs' and '_docs' directories:"
    while IFS= read -r docs_dir; do
        module_path=$(dirname "$docs_dir")
        if [[ -d "$module_path/docs" && -d "$module_path/_docs" ]]; then
            echo "- $module_path (has both docs/ and _docs/)"
        fi
    done < "$ANALYSIS_DIR/docs_directories.txt"
    echo ""
    echo "### 2. Nested docs directories"
    echo "Some modules have deeply nested documentation:"
    grep "source/docs" "$ANALYSIS_DIR/docs_directories.txt" | head -10
    echo ""
    echo "### 3. Documentation in non-standard locations"
    find "$PROJECT_ROOT" -path "*/app/*/docs" -type d | head -10
    echo ""
} > "$ANALYSIS_DIR/structure_report.md"

echo "✅ Analysis complete!"
echo "📄 Reports generated in: $ANALYSIS_DIR"
echo "   - docs_directories.txt: All documentation directories"
echo "   - content_patterns.txt: Content pattern analysis"
echo "   - duplicate_files.txt: Files with duplicate content"
echo "   - structure_report.md: Summary report"
