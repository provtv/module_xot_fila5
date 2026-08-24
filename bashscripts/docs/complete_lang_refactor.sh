#!/bin/bash

# Complete Lang module docs refactoring with all essential files
# Following DRY + KISS + SOLID + Laraxot principles

set -euo pipefail

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
PROJECT_ROOT="$(cd "$SCRIPT_DIR/../../../.." && pwd)"
LANG_DOCS_DIR="$PROJECT_ROOT/Modules/Lang/docs"

echo "🔧 Creating complete Lang module docs refactoring..."

# Create backup
BACKUP_DIR="$LANG_DOCS_DIR.backup.$(date +%Y%m%d_%H%M%S)"
echo "📁 Creating backup: $BACKUP_DIR"
cp -r "$LANG_DOCS_DIR" "$BACKUP_DIR"

# Create new clean structure
TEMP_DIR="$LANG_DOCS_DIR.new"
mkdir -p "$TEMP_DIR"

# 1. README.md - Navigation and quick reference
cat > "$TEMP_DIR/README.md" << 'EOF'
# Lang Module Documentation

Comprehensive translation and localization support for Laraxot PTVX applications.

## Quick Reference

### Core Components
- **Translation System**: Automatic translation management with Filament integration
- **Laravel Localization**: Integration with Laravel's localization features  
- **File Structure**: Organized translation file management
- **Migration Patterns**: Database-driven translation handling

### Key Features
- Automatic label generation for Filament components
- Multi-language support with locale switching
- Translation file validation and syntax checking
- PHPStan level 9+ compliance
- Conflict resolution tools

## Documentation Structure

1. [Translation System](translation-system.md) - Core translation system fundamentals
2. [Filament Integration](filament-integration.md) - How translations work with Filament
3. [Laravel Localization](laravel-localization.md) - Laravel localization integration
4. [File Structure](file-structure.md) - Translation file organization and syntax
5. [Migration Patterns](migration-patterns.md) - Migration handling
6. [Conflict Resolution](conflict-resolution.md) - Common issues and solutions
7. [PHPStan Compliance](phpstan-compliance.md) - Code quality requirements
8. [Best Practices](best-practices.md) - Guidelines and conventions

## Business Logic Focus

The Lang module focuses on:
- **Automatic Translation**: Reduces manual translation work
- **Consistency**: Ensures consistent translations across modules
- **Performance**: Optimized translation loading and caching
- **Developer Experience**: Simple API for translation management
- **Quality**: Enforces translation standards and validation

## Quick Start

```php
// Automatic Filament label translation
TextInput::make('name'), // Automatically uses lang files

// Manual translation
__('lang::fields.name.label')

// Locale switching
app()->setLocale('it');
```

## Links
- [Laraxot Framework Documentation](../../../docs/)
- [Filament Documentation](https://filamentphp.com)
- [Laravel Localization](https://laravel.com/docs/localization)
EOF

# 2. Translation System
cat > "$TEMP_DIR/translation-system.md" << 'EOF'
# Translation System

The Lang module provides a comprehensive translation system built on Laravel's localization with enhanced features for Laraxot PTVX.

## Architecture

### Core Components

1. **LangServiceProvider**: Automatic translation loading and Filament integration
2. **Translation Files**: Structured translation storage in modules
3. **Automatic Labels**: Dynamic label generation for Filament components
4. **Locale Management**: Multi-language support with switching

### File Structure

```
Modules/{ModuleName}/lang/{locale}/
├── fields.php          # Form field translations
├── actions.php         # Action button translations
├── navigation.php      # Navigation menu translations
├── messages.php        # System messages
└── validation.php      # Validation messages
```

### Translation Format

```php
<?php

declare(strict_types=1);

return [
    'fields' => [
        'name' => [
            'label' => 'Nome',
            'placeholder' => 'Inserisci il nome',
            'helper_text' => 'Il nome deve essere univoco',
        ],
    ],
    'actions' => [
        'create' => [
            'label' => 'Crea nuovo',
            'success' => 'Elemento creato con successo',
            'error' => 'Errore durante la creazione',
        ],
    ],
];
```

## Business Logic

### Automatic Translation Loading

The system automatically loads translations for:
- Filament form fields
- Table columns
- Action buttons
- Navigation items
- Validation messages

### Performance Optimization

- Lazy loading of translation files
- Caching of frequently used translations
- Optimized file structure for fast access

### Integration Points

- **Filament**: Automatic label generation
- **Laravel**: Standard localization features
- **Modules**: Per-module translation isolation
- **Database**: Migration-based translation updates
EOF

# 3. Filament Integration
cat > "$TEMP_DIR/filament-integration.md" << 'EOF'
# Filament Integration

The Lang module provides seamless integration with Filament components for automatic translation.

## Automatic Label Generation

### Form Fields

```php
// Automatic translation - NO ->label() needed
TextInput::make('name'),
Select::make('category_id'),
DatePicker::make('created_at'),

// Translation file: lang/it/fields.php
return [
    'name' => [
        'label' => 'Nome',
        'placeholder' => 'Inserisci il nome',
        'helper_text' => 'Nome univoco per l\'elemento',
    ],
    'category_id' => [
        'label' => 'Categoria',
        'placeholder' => 'Seleziona categoria',
        'helper_text' => 'Categoria di appartenenza',
    ],
];
```

### Table Columns

```php
// Automatic translation
TextColumn::make('name'),
TextColumn::make('status'),

// Translation file handles labels automatically
```

### Actions

```php
// Automatic translation
CreateAction::make(),
EditAction::make(),
DeleteAction::make(),

// Translation file: lang/it/actions.php
return [
    'create' => [
        'label' => 'Crea nuovo',
        'modal_heading' => 'Crea nuovo elemento',
        'success' => 'Elemento creato con successo',
    ],
];
```

## Critical Rules

### NEVER Use These Methods

```php
// ❌ FORBIDDEN - These methods are prohibited
TextInput::make('name')
    ->label('Nome')           // NEVER use ->label()
    ->placeholder('...')      // NEVER use ->placeholder()
    ->helperText('...');      // NEVER use ->helperText()
```

### Always Use Translation Files

```php
// ✅ CORRECT - Let the system handle translations
TextInput::make('name'),     // Uses lang files automatically
```

## Business Logic Benefits

- **Consistency**: All translations managed centrally
- **Maintainability**: Easy to update translations
- **Internationalization**: Simple locale switching
- **Developer Experience**: No manual label management
- **Quality**: Enforced translation standards
EOF

# 4. Laravel Localization
cat > "$TEMP_DIR/laravel-localization.md" << 'EOF'
# Laravel Localization Integration

Integration with Laravel's built-in localization features enhanced for Laraxot PTVX.

## Locale Management

### Supported Locales

- `it` (Italian) - Primary locale
- `en` (English) - Secondary locale
- Additional locales can be added per project needs

### Locale Switching

```php
// Set application locale
app()->setLocale('it');

// Get current locale
$locale = app()->getLocale();

// Check if locale is supported
$isSupported = in_array($locale, config('app.available_locales'));
```

### URL-based Localization

Integration with mcamara/laravel-localization for URL-based locale switching:

```php
// Routes with locale prefix
Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect']
], function() {
    // Your routes here
});
```

## Translation Helpers

### Standard Laravel Helpers

```php
// Basic translation
__('lang::messages.welcome')

// Translation with parameters
__('lang::messages.welcome_user', ['name' => $user->name])

// Pluralization
trans_choice('lang::messages.items', $count)
```

### Laraxot Extensions

```php
// Automatic field translation
$label = trans("$moduleName::fields.$fieldName.label");

// Fallback translation
$text = trans_fallback('custom.key', 'Default text');
```

## Date and Number Localization

### Date Formatting

```php
// Localized date formatting
Carbon::now()->locale('it')->isoFormat('LLLL');

// In Blade templates
{{ $date->locale(app()->getLocale())->isoFormat('L') }}
```

### Number Formatting

```php
// Currency formatting
number_format($amount, 2, ',', '.');

// Percentage formatting
$percentage = round($value * 100, 2) . '%';
```

## Business Logic Integration

- **User Preferences**: Store user locale preferences
- **Content Management**: Multi-language content support
- **Form Validation**: Localized validation messages
- **Email Templates**: Multi-language email support
EOF

# 5. File Structure
cat > "$TEMP_DIR/file-structure.md" << 'EOF'
# Translation File Structure

Standardized organization and syntax for translation files in Laraxot PTVX.

## Directory Structure

```
Modules/{ModuleName}/lang/
├── it/                 # Italian translations
│   ├── fields.php      # Form field translations
│   ├── actions.php     # Action button translations
│   ├── navigation.php  # Navigation menu translations
│   ├── messages.php    # System messages
│   └── validation.php  # Validation messages
└── en/                 # English translations
    ├── fields.php
    ├── actions.php
    ├── navigation.php
    ├── messages.php
    └── validation.php
```

## File Syntax Standards

### Required Header

```php
<?php

declare(strict_types=1);

return [
    // Translation content
];
```

### Field Translations Structure

```php
return [
    'fields' => [
        'field_name' => [
            'label' => 'Field Label',
            'placeholder' => 'Placeholder text',
            'helper_text' => 'Help text for the field',
        ],
    ],
];
```

### Action Translations Structure

```php
return [
    'actions' => [
        'action_name' => [
            'label' => 'Action Label',
            'modal_heading' => 'Modal Title',
            'modal_description' => 'Modal description',
            'success' => 'Success message',
            'error' => 'Error message',
        ],
    ],
];
```

### Navigation Translations Structure

```php
return [
    'navigation' => [
        'label' => 'Navigation Label',
        'group' => 'Group Name',
        'icon' => 'heroicon-o-icon-name',
        'sort' => 10,
    ],
];
```

## Naming Conventions

### File Names
- Use lowercase with underscores: `field_name.php`
- Avoid dashes in file names
- Use descriptive names: `user_management.php`

### Translation Keys
- Use snake_case for keys: `user_name`
- Use descriptive keys: `email_address` not `email`
- Group related keys: `user.name`, `user.email`

### Required Fields
Every field translation must include:
- `label`: Display label
- `placeholder`: Input placeholder
- `helper_text`: Help text (can be empty string)

## Business Logic Rules

### Consistency
- Same structure across all modules
- Consistent naming patterns
- Complete translation coverage

### Performance
- Lazy loading of translation files
- Optimized file structure
- Minimal memory footprint

### Maintainability
- Clear organization
- Easy to locate translations
- Simple update process
EOF

# 6. Migration Patterns
cat > "$TEMP_DIR/migration-patterns.md" << 'EOF'
# Migration Patterns

Database migration patterns for translation management in Laraxot PTVX.

## Translation Table Migrations

### Basic Translation Table

```php
<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Xot\Database\Migrations\XotBaseMigration;

return new class extends XotBaseMigration
{
    protected string $table_name = 'translations';

    public function up(): void
    {
        if (Schema::hasTable($this->table_name)) {
            return;
        }

        Schema::create($this->table_name, function (Blueprint $table) {
            $table->id();
            $table->string('key');
            $table->string('locale', 5);
            $table->text('value');
            $table->string('group')->nullable();
            $table->timestamps();
            
            $table->index(['key', 'locale']);
            $table->unique(['key', 'locale', 'group']);
        });
    }
};
```

### Translatable Model Migration

```php
<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Xot\Database\Migrations\XotBaseMigration;

return new class extends XotBaseMigration
{
    protected string $table_name = 'articles';

    public function up(): void
    {
        if (Schema::hasTable($this->table_name)) {
            return;
        }

        Schema::create($this->table_name, function (Blueprint $table) {
            $table->id();
            $table->json('title'); // Translatable field
            $table->json('content'); // Translatable field
            $table->string('slug');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }
};
```

## Migration Best Practices

### Always Use XotBaseMigration

```php
// ✅ CORRECT
return new class extends XotBaseMigration
{
    // Migration code
};

// ❌ WRONG
class CreateTranslationsTable extends Migration
{
    // Migration code
}
```

### Check Table Existence

```php
public function up(): void
{
    if (Schema::hasTable($this->table_name)) {
        return;
    }
    
    // Create table
}
```

### Never Implement down()

```php
// ❌ NEVER implement down() method in XotBaseMigration
public function down(): void
{
    Schema::dropIfExists($this->table_name);
}
```

## Translation Seeding

### Translation Seeder

```php
<?php

declare(strict_types=1);

namespace Modules\Lang\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Lang\Models\Translation;

class TranslationSeeder extends Seeder
{
    public function run(): void
    {
        $translations = [
            ['key' => 'welcome', 'locale' => 'it', 'value' => 'Benvenuto'],
            ['key' => 'welcome', 'locale' => 'en', 'value' => 'Welcome'],
        ];

        foreach ($translations as $translation) {
            Translation::updateOrCreate(
                ['key' => $translation['key'], 'locale' => $translation['locale']],
                $translation
            );
        }
    }
}
```

## Business Logic Considerations

### Performance
- Index frequently queried columns
- Use appropriate data types
- Consider caching strategies

### Scalability
- Plan for multiple locales
- Consider translation volume
- Optimize for read operations

### Data Integrity
- Unique constraints on key combinations
- Foreign key relationships where appropriate
- Validation at database level
EOF

# 7. Conflict Resolution
cat > "$TEMP_DIR/conflict-resolution.md" << 'EOF'
# Conflict Resolution

Common translation-related issues and their solutions in Laraxot PTVX.

## Common Issues

### 1. Merge Conflicts in Translation Files

**Problem**: Git merge conflicts in translation files due to array syntax differences.

**Solution**:
```bash
# Use the conflict resolution script
./Modules/Xot/bashscripts/conflicts/fix_merge_conflicts.sh

# Manual resolution steps:
# 1. Remove conflict markers
# 2. Ensure declare(strict_types=1)
# 3. Use short array syntax []
# 4. Validate syntax
```

### 2. Missing Translation Keys

**Problem**: Filament components show untranslated keys instead of labels.

**Solution**:
```php
// Ensure translation file exists: lang/it/fields.php
return [
    'fields' => [
        'field_name' => [
            'label' => 'Campo Nome',
            'placeholder' => 'Inserisci nome',
            'helper_text' => 'Testo di aiuto',
        ],
    ],
];
```

### 3. Translation File Syntax Errors

**Problem**: PHP syntax errors in translation files.

**Solution**:
```bash
# Check syntax
php -l Modules/ModuleName/lang/it/file.php

# Common fixes:
# - Missing commas
# - Unmatched brackets
# - Missing semicolons
```

### 4. Filament Label Override Issues

**Problem**: Using ->label() methods breaks automatic translation.

**Solution**:
```php
// ❌ WRONG - Breaks automatic translation
TextInput::make('name')->label('Nome')

// ✅ CORRECT - Uses automatic translation
TextInput::make('name')
```

### 5. Locale Not Loading

**Problem**: Translations not loading for specific locale.

**Solution**:
```php
// Check locale configuration
config('app.locale'); // Should return expected locale

// Verify translation files exist
file_exists(resource_path('lang/it/messages.php'));

// Clear translation cache
php artisan cache:clear
php artisan config:clear
```

## Debugging Tools

### Translation Key Finder

```bash
# Find missing translation keys
grep -r "lang::" Modules/ | grep -v ".php:"
```

### Syntax Validation

```bash
# Validate all translation files
find Modules/*/lang -name "*.php" -exec php -l {} \;
```

### Translation Coverage Check

```php
// Check if all required translations exist
$requiredKeys = ['label', 'placeholder', 'helper_text'];
$translations = include 'lang/it/fields.php';

foreach ($translations['fields'] as $field => $trans) {
    foreach ($requiredKeys as $key) {
        if (!isset($trans[$key])) {
            echo "Missing $key for field $field\n";
        }
    }
}
```

## Prevention Strategies

### 1. Automated Validation

```bash
# Add to CI/CD pipeline
./scripts/validate_translations.sh
```

### 2. Translation Templates

Use consistent templates for new translation files.

### 3. Code Review Checklist

- [ ] No ->label() methods used
- [ ] Translation files have proper structure
- [ ] All required keys present
- [ ] Syntax validation passes

### 4. Development Guidelines

- Always use translation files
- Never hardcode strings
- Follow naming conventions
- Test with multiple locales

## Business Logic Impact

### User Experience
- Consistent translations improve UX
- Proper error handling prevents confusion
- Multi-language support increases accessibility

### Development Efficiency
- Automated translation reduces manual work
- Conflict resolution tools save time
- Standardized patterns improve maintainability

### System Reliability
- Proper validation prevents runtime errors
- Consistent structure enables automation
- Clear documentation reduces support issues
EOF

# 8. PHPStan Compliance
cat > "$TEMP_DIR/phpstan-compliance.md" << 'EOF'
# PHPStan Compliance

Code quality requirements and PHPStan compliance for translation files in Laraxot PTVX.

## PHPStan Level 9+ Requirements

### Translation File Structure

```php
<?php

declare(strict_types=1); // Required for all files

/**
 * @return array<string, array<string, array<string, string>>>
 */
return [
    'fields' => [
        'name' => [
            'label' => 'Nome',
            'placeholder' => 'Inserisci nome',
            'helper_text' => 'Testo di aiuto',
        ],
    ],
];
```

### Type Annotations

```php
/**
 * Translation service for handling multi-language content.
 */
class TranslationService
{
    /**
     * Get translated field label.
     *
     * @param string $module
     * @param string $field
     * @return string
     */
    public function getFieldLabel(string $module, string $field): string
    {
        return trans("{$module}::fields.{$field}.label");
    }

    /**
     * Get all field translations for a module.
     *
     * @param string $module
     * @return array<string, array<string, string>>
     */
    public function getFieldTranslations(string $module): array
    {
        return trans("{$module}::fields");
    }
}
```

## Common PHPStan Issues and Fixes

### 1. Missing Return Type

```php
// ❌ PHPStan Error: Missing return type
public function getTranslation($key)
{
    return trans($key);
}

// ✅ Fixed
public function getTranslation(string $key): string
{
    return trans($key);
}
```

### 2. Mixed Type Usage

```php
// ❌ PHPStan Error: Mixed type
public function processTranslations($data)
{
    // Process data
}

// ✅ Fixed
/**
 * @param array<string, mixed> $data
 */
public function processTranslations(array $data): void
{
    // Process data
}
```

### 3. Array Shape Annotations

```php
// ❌ PHPStan Error: Unspecified array shape
public function getFieldConfig(): array
{
    return [
        'label' => 'Nome',
        'required' => true,
    ];
}

// ✅ Fixed
/**
 * @return array{label: string, required: bool}
 */
public function getFieldConfig(): array
{
    return [
        'label' => 'Nome',
        'required' => true,
    ];
}
```

### 4. Translation File Validation

```php
// ❌ PHPStan Error: Unsafe array access
$label = $translations['fields'][$field]['label'];

// ✅ Fixed
$label = $translations['fields'][$field]['label'] ?? 'Default Label';

// Or with proper validation
if (!isset($translations['fields'][$field]['label'])) {
    throw new InvalidArgumentException("Missing label for field: {$field}");
}
$label = $translations['fields'][$field]['label'];
```

## Validation Scripts

### PHPStan Configuration

```neon
# phpstan.neon
parameters:
    level: 9
    paths:
        - Modules/Lang
    excludePaths:
        - Modules/Lang/vendor
    checkMissingIterableValueType: false
    checkGenericClassInNonGenericObjectType: false
```

### Automated Checks

```bash
# Run PHPStan on Lang module
./vendor/bin/phpstan analyze Modules/Lang --level=9

# Check specific translation files
./vendor/bin/phpstan analyze Modules/Lang/lang --level=9
```

## Best Practices

### 1. Strict Types

Always use `declare(strict_types=1);` in all PHP files.

### 2. Complete Type Annotations

Provide complete PHPDoc annotations for all methods and properties.

### 3. Array Shape Definitions

Define exact array shapes for translation structures.

### 4. Null Safety

Handle null cases explicitly, avoid unsafe array access.

### 5. Generic Types

Use generic type annotations for collections and arrays.

## Business Logic Benefits

### Code Quality
- Higher code quality through static analysis
- Early detection of type-related bugs
- Improved IDE support and autocompletion

### Maintainability
- Self-documenting code through type annotations
- Easier refactoring with type safety
- Reduced debugging time

### Team Collaboration
- Clear contracts through type definitions
- Consistent code standards
- Better code review process
EOF

# 9. Best Practices
cat > "$TEMP_DIR/best-practices.md" << 'EOF'
# Best Practices

Guidelines and conventions for translation management in Laraxot PTVX.

## Translation File Organization

### Module Structure

```
Modules/{ModuleName}/
├── lang/
│   ├── it/
│   │   ├── fields.php      # Form field translations
│   │   ├── actions.php     # Action button translations
│   │   ├── navigation.php  # Navigation menu translations
│   │   ├── messages.php    # System messages
│   │   └── validation.php  # Validation messages
│   └── en/
│       ├── fields.php
│       ├── actions.php
│       ├── navigation.php
│       ├── messages.php
│       └── validation.php
```

### File Naming Conventions

- Use lowercase with underscores: `user_management.php`
- Avoid dashes in file names
- Use descriptive names that reflect content
- Group related translations in same file

## Translation Key Structure

### Hierarchical Organization

```php
return [
    'fields' => [
        'user' => [
            'name' => [
                'label' => 'Nome Utente',
                'placeholder' => 'Inserisci nome utente',
                'helper_text' => 'Nome univoco per l\'utente',
            ],
            'email' => [
                'label' => 'Email',
                'placeholder' => 'Inserisci email',
                'helper_text' => 'Indirizzo email valido',
            ],
        ],
    ],
];
```

### Required Structure Elements

Every field translation must include:
- `label`: Display label for the field
- `placeholder`: Placeholder text for inputs
- `helper_text`: Help text (can be empty string if not needed)

## Filament Integration Best Practices

### Automatic Translation Usage

```php
// ✅ CORRECT - Automatic translation
TextInput::make('name'),
Select::make('category_id'),
DatePicker::make('created_at'),

// ❌ WRONG - Manual labels break the system
TextInput::make('name')->label('Nome'),
```

### Action Translations

```php
// ✅ CORRECT - Automatic action translation
CreateAction::make(),
EditAction::make(),
DeleteAction::make(),

// Translation file: lang/it/actions.php
return [
    'create' => [
        'label' => 'Crea nuovo',
        'modal_heading' => 'Crea nuovo elemento',
        'success' => 'Elemento creato con successo',
        'error' => 'Errore durante la creazione',
    ],
];
```

## Code Quality Standards

### PHP Standards

```php
<?php

declare(strict_types=1); // Always required

/**
 * @return array<string, array<string, array<string, string>>>
 */
return [
    // Translation content with proper type annotations
];
```

### Validation

```bash
# Syntax validation
php -l translation_file.php

# PHPStan validation
./vendor/bin/phpstan analyze Modules/ModuleName/lang --level=9
```

## Performance Optimization

### Lazy Loading

- Translation files are loaded only when needed
- Cache frequently used translations
- Optimize file structure for fast access

### Memory Management

- Use appropriate data structures
- Avoid loading unnecessary translations
- Implement efficient caching strategies

## Development Workflow

### 1. Create Translation Structure

```bash
# Create translation directories
mkdir -p Modules/ModuleName/lang/{it,en}

# Create translation files
touch Modules/ModuleName/lang/it/{fields,actions,navigation,messages,validation}.php
```

### 2. Define Translation Schema

```php
// Start with basic structure
return [
    'fields' => [],
    'actions' => [],
    'navigation' => [],
    'messages' => [],
    'validation' => [],
];
```

### 3. Implement Translations

Add translations as you develop components:

```php
// Add field translations as you create forms
'fields' => [
    'name' => [
        'label' => 'Nome',
        'placeholder' => 'Inserisci nome',
        'helper_text' => 'Nome univoco',
    ],
],
```

### 4. Test and Validate

```bash
# Test translation loading
php artisan tinker
>>> trans('modulename::fields.name.label')

# Validate syntax
php -l Modules/ModuleName/lang/it/fields.php

# Run PHPStan
./vendor/bin/phpstan analyze Modules/ModuleName --level=9
```

## Common Pitfalls to Avoid

### 1. Using Manual Labels

```php
// ❌ NEVER do this
TextInput::make('name')->label('Nome')
```

### 2. Inconsistent Structure

```php
// ❌ WRONG - Inconsistent structure
'name' => 'Nome', // Missing placeholder and helper_text

// ✅ CORRECT - Complete structure
'name' => [
    'label' => 'Nome',
    'placeholder' => 'Inserisci nome',
    'helper_text' => 'Nome univoco',
],
```

### 3. Missing Translations

Always provide translations for all supported locales.

### 4. Hardcoded Strings

Never use hardcoded strings in views or components.

## Business Logic Benefits

### Consistency
- Uniform translation structure across modules
- Consistent user experience
- Standardized development patterns

### Maintainability
- Easy to update translations
- Clear organization and structure
- Automated validation and testing

### Scalability
- Support for multiple languages
- Efficient loading and caching
- Modular translation management

### Developer Experience
- Automatic label generation
- Clear documentation and examples
- Reduced manual translation work
EOF

# Replace old docs with new structure
echo "🔄 Replacing old documentation structure..."
rm -rf "$LANG_DOCS_DIR"
mv "$TEMP_DIR" "$LANG_DOCS_DIR"

echo "🎉 Lang module docs refactoring completed!"
echo "📊 Reduced from 200+ files to 9 essential files"
echo "✅ Applied DRY + KISS + SOLID + Laraxot principles"
echo "📁 Backup available at: $BACKUP_DIR"
echo ""
echo "New structure:"
echo "├── README.md (Navigation and quick reference)"
echo "├── translation-system.md (Core fundamentals)"
echo "├── filament-integration.md (Filament integration)"
echo "├── laravel-localization.md (Laravel integration)"
echo "├── file-structure.md (File organization)"
echo "├── migration-patterns.md (Database patterns)"
echo "├── conflict-resolution.md (Common issues)"
echo "├── phpstan-compliance.md (Code quality)"
echo "└── best-practices.md (Guidelines)"
