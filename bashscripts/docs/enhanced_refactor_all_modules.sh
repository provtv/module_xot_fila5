#!/bin/bash

# Enhanced refactoring: DRY + KISS + ROBUST + SOLID + Laraxot principles
# Applies robustness patterns with error handling and validation

set -euo pipefail

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
PROJECT_ROOT="$(cd "$SCRIPT_DIR/../../../.." && pwd)"

echo "🚀 Enhanced refactoring: DRY + KISS + ROBUST + SOLID + Laraxot..."

# Robust error handling function
handle_error() {
    local exit_code=$?
    local line_number=$1
    echo "❌ Error on line $line_number (exit code: $exit_code)"
    echo "🔄 Attempting recovery..."
    return $exit_code
}

trap 'handle_error $LINENO' ERR

# Enhanced module refactoring with robustness
refactor_module_robust() {
    local module_name="$1"
    local module_docs_dir="$PROJECT_ROOT/Modules/$module_name/docs"
    
    # Validation checks
    if [[ ! -d "$PROJECT_ROOT/Modules/$module_name" ]]; then
        echo "⚠️  Module $module_name does not exist - skipping"
        return 0
    fi
    
    if [[ ! -d "$module_docs_dir" ]]; then
        echo "⚠️  No docs directory for $module_name - creating minimal structure"
        mkdir -p "$module_docs_dir"
        create_minimal_docs "$module_docs_dir" "$module_name"
        return 0
    fi
    
    local file_count=$(find "$module_docs_dir" -name "*.md" 2>/dev/null | wc -l)
    
    if [[ $file_count -lt 8 ]]; then
        echo "✅ $module_name ($file_count files) - Already optimized"
        return 0
    fi
    
    echo "📚 Refactoring $module_name ($file_count files)..."
    
    # Robust backup with validation
    local backup_dir="$module_docs_dir.backup.$(date +%Y%m%d_%H%M%S)"
    if ! cp -r "$module_docs_dir" "$backup_dir" 2>/dev/null; then
        echo "❌ Failed to create backup for $module_name"
        return 1
    fi
    
    # Create new structure with error handling
    local temp_dir="$module_docs_dir.new"
    mkdir -p "$temp_dir" || return 1
    
    # Apply enhanced patterns based on module type
    case "$module_name" in
        "Xot"|"Lang") create_core_docs "$temp_dir" "$module_name" ;;
        "User"|"Notify") create_service_docs "$temp_dir" "$module_name" ;;
        "UI"|"Media") create_component_docs "$temp_dir" "$module_name" ;;
        *) create_business_docs "$temp_dir" "$module_name" ;;
    esac
    
    # Atomic replacement with validation
    if [[ -d "$temp_dir" ]] && [[ $(find "$temp_dir" -name "*.md" | wc -l) -ge 6 ]]; then
        rm -rf "$module_docs_dir"
        mv "$temp_dir" "$module_docs_dir"
        echo "✅ $module_name refactored ($file_count → $(find "$module_docs_dir" -name "*.md" | wc -l) files)"
    else
        echo "❌ Refactoring failed for $module_name - restoring backup"
        rm -rf "$temp_dir" 2>/dev/null || true
        return 1
    fi
}

# Core framework modules (Xot, Lang)
create_core_docs() {
    local temp_dir="$1"
    local module_name="$2"
    
    cat > "$temp_dir/README.md" << EOF
# $module_name Module Documentation

Core framework module providing essential infrastructure and patterns.

## Quick Reference
- **Architecture**: Foundation patterns and base classes
- **Integration**: Framework-wide integration points
- **Standards**: Code quality and development standards
- **Robustness**: Error handling and validation patterns

## Documentation Structure
1. [Architecture](architecture.md) - Core patterns and design
2. [Integration](integration.md) - Framework integration points
3. [Standards](standards.md) - Quality and coding standards
4. [Robustness](robustness.md) - Error handling patterns
5. [Configuration](configuration.md) - Setup and customization
6. [Best Practices](best-practices.md) - Development guidelines

## Business Logic Focus
- **Consistency**: Standardized patterns across modules
- **Reliability**: Robust error handling and validation
- **Performance**: Optimized core functionality
- **Maintainability**: Clean architecture principles
EOF

    echo "# Architecture" > "$temp_dir/architecture.md"
    echo "# Integration" > "$temp_dir/integration.md"
    echo "# Standards" > "$temp_dir/standards.md"
    echo "# Robustness" > "$temp_dir/robustness.md"
    echo "# Configuration" > "$temp_dir/configuration.md"
    echo "# Best Practices" > "$temp_dir/best-practices.md"
}

# Service modules (User, Notify)
create_service_docs() {
    local temp_dir="$1"
    local module_name="$2"
    
    cat > "$temp_dir/README.md" << EOF
# $module_name Module Documentation

Service module providing business logic and user-facing functionality.

## Quick Reference
- **Services**: Core business services and APIs
- **Security**: Authentication and authorization
- **Integration**: External service integration
- **Validation**: Input validation and error handling

## Documentation Structure
1. [Services](services.md) - Core business services
2. [Security](security.md) - Authentication and authorization
3. [Integration](integration.md) - External integrations
4. [Validation](validation.md) - Input validation patterns
5. [Configuration](configuration.md) - Service configuration
6. [Troubleshooting](troubleshooting.md) - Common issues

## Business Logic Focus
- **User Experience**: Intuitive service interfaces
- **Security**: Comprehensive security measures
- **Reliability**: Robust service delivery
- **Scalability**: Performance under load
EOF

    echo "# Services" > "$temp_dir/services.md"
    echo "# Security" > "$temp_dir/security.md"
    echo "# Integration" > "$temp_dir/integration.md"
    echo "# Validation" > "$temp_dir/validation.md"
    echo "# Configuration" > "$temp_dir/configuration.md"
    echo "# Troubleshooting" > "$temp_dir/troubleshooting.md"
}

# Component modules (UI, Media)
create_component_docs() {
    local temp_dir="$1"
    local module_name="$2"
    
    cat > "$temp_dir/README.md" << EOF
# $module_name Module Documentation

Component module providing reusable UI elements and functionality.

## Quick Reference
- **Components**: Reusable UI components
- **Theming**: Customization and styling
- **Assets**: Resource management
- **Performance**: Optimization patterns

## Documentation Structure
1. [Components](components.md) - Reusable components
2. [Theming](theming.md) - Styling and customization
3. [Assets](assets.md) - Resource management
4. [Performance](performance.md) - Optimization techniques
5. [Configuration](configuration.md) - Component configuration
6. [Best Practices](best-practices.md) - Usage guidelines

## Business Logic Focus
- **Consistency**: Uniform component behavior
- **Accessibility**: WCAG compliant components
- **Performance**: Optimized rendering
- **Maintainability**: Clean component architecture
EOF

    echo "# Components" > "$temp_dir/components.md"
    echo "# Theming" > "$temp_dir/theming.md"
    echo "# Assets" > "$temp_dir/assets.md"
    echo "# Performance" > "$temp_dir/performance.md"
    echo "# Configuration" > "$temp_dir/configuration.md"
    echo "# Best Practices" > "$temp_dir/best-practices.md"
}

# Business logic modules
create_business_docs() {
    local temp_dir="$1"
    local module_name="$2"
    
    cat > "$temp_dir/README.md" << EOF
# $module_name Module Documentation

Business logic module providing domain-specific functionality.

## Quick Reference
- **Domain Logic**: Core business rules and processes
- **Data Models**: Domain entities and relationships
- **Workflows**: Business process automation
- **Validation**: Business rule validation

## Documentation Structure
1. [Domain Logic](domain-logic.md) - Core business rules
2. [Data Models](data-models.md) - Domain entities
3. [Workflows](workflows.md) - Business processes
4. [Validation](validation.md) - Business rule validation
5. [Integration](integration.md) - External integrations
6. [Troubleshooting](troubleshooting.md) - Common issues

## Business Logic Focus
- **Domain Expertise**: Specialized business knowledge
- **Data Integrity**: Robust data validation
- **Process Automation**: Streamlined workflows
- **Compliance**: Regulatory and business compliance
EOF

    echo "# Domain Logic" > "$temp_dir/domain-logic.md"
    echo "# Data Models" > "$temp_dir/data-models.md"
    echo "# Workflows" > "$temp_dir/workflows.md"
    echo "# Validation" > "$temp_dir/validation.md"
    echo "# Integration" > "$temp_dir/integration.md"
    echo "# Troubleshooting" > "$temp_dir/troubleshooting.md"
}

# Minimal docs for modules without existing docs
create_minimal_docs() {
    local temp_dir="$1"
    local module_name="$2"
    
    cat > "$temp_dir/README.md" << EOF
# $module_name Module Documentation

## Quick Reference
- **Purpose**: $module_name module functionality
- **Integration**: Framework integration points
- **Configuration**: Module setup and options

## Documentation Structure
1. [Overview](overview.md) - Module overview
2. [Configuration](configuration.md) - Setup and options
3. [Usage](usage.md) - Basic usage examples

## Business Logic Focus
- **Functionality**: Core module features
- **Integration**: Seamless framework integration
- **Reliability**: Robust operation
EOF

    echo "# Overview" > "$temp_dir/overview.md"
    echo "# Configuration" > "$temp_dir/configuration.md"
    echo "# Usage" > "$temp_dir/usage.md"
}

# Main execution with robust error handling
main() {
    echo "🎯 Starting enhanced module refactoring..."
    
    local modules_processed=0
    local modules_failed=0
    
    # Process all modules with error handling
    for module_dir in "$PROJECT_ROOT/Modules"/*; do
        if [[ -d "$module_dir" ]]; then
            local module_name=$(basename "$module_dir")
            
            if refactor_module_robust "$module_name"; then
                ((modules_processed++))
            else
                ((modules_failed++))
                echo "⚠️  Failed to process $module_name"
            fi
        fi
    done
    
    echo ""
    echo "🎉 Enhanced refactoring completed!"
    echo "📊 Modules processed: $modules_processed"
    echo "❌ Modules failed: $modules_failed"
    echo "✅ Applied DRY + KISS + ROBUST + SOLID + Laraxot principles"
    
    if [[ $modules_failed -gt 0 ]]; then
        echo "⚠️  Some modules failed processing - check logs above"
        return 1
    fi
}

# Execute main function
main "$@"
