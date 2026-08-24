<?php

declare(strict_types=1);

namespace Modules\Xot\Filament\Resources;

<<<<<<< .merge_file_AHYXoN
use Exception;
=======
>>>>>>> .merge_file_oDpjTE
use Filament\Pages\Enums\SubNavigationPosition;
use Filament\Resources\Pages\Page;
use Filament\Resources\Pages\PageRegistration;
use Filament\Resources\RelationManagers\RelationGroup;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\RelationManagers\RelationManagerConfiguration;
use Filament\Resources\Resource as FilamentResource;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Schema;
use Filament\Support\Components\Component;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\View;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;
use LogicException;
use Modules\Media\Actions\GetAttachmentsSchemaAction;
use Modules\Xot\Actions\Filament\GetResourceClassNameByModelClassAction;
use Modules\Xot\Actions\GetTransKeyAction;
use Modules\Xot\Actions\ModelClass\CountAction;
use Modules\Xot\Filament\Resources\Schemas\XotBaseResourceForm;
use Modules\Xot\Filament\Resources\Schemas\XotBaseResourceInfolist;
use Modules\Xot\Filament\Resources\Tables\XotBaseResourceTable;
use Modules\Xot\Filament\Traits\NavigationLabelTrait;
<<<<<<< .merge_file_AHYXoN
use ReflectionClass;
use Webmozart\Assert\Assert;

use function Safe\glob;

=======

use function Safe\glob;

use Webmozart\Assert\Assert;

>>>>>>> .merge_file_oDpjTE
/**
 * @method static string getUrl(?string $name = null, array<string, mixed> $parameters = [], bool $isAbsolute = true, ?string $panel = null, ?\Illuminate\Database\Eloquent\Model $tenant = null, bool $shouldGuessMissingParameters = false, ?string $configuration = null)
 */
abstract class XotBaseResource extends FilamentResource
{
    use NavigationLabelTrait;

    protected static ?string $model = null;

    protected static ?SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    /**
<<<<<<< .merge_file_AHYXoN
     * @param  array<string, bool|float|int|string|null>  $params
=======
     * @param array<string, bool|float|int|string|null> $params
>>>>>>> .merge_file_oDpjTE
     */
    public static function trans(string $key, bool $exceptionIfNotExist = false, array $params = []): string
    {
        $tmp = static::getKeyTrans($key);
        $res = trans($tmp, $params);

        if (is_string($res)) {
            if ($exceptionIfNotExist && $res === $tmp) {
<<<<<<< .merge_file_AHYXoN
                throw new Exception('['.__LINE__.']['.class_basename(self::class).']');
=======
                throw new \Exception('['.__LINE__.']['.class_basename(self::class).']');
>>>>>>> .merge_file_oDpjTE
            }

            return $res;
        }

        if (is_array($res)) {
            $first = current($res);
            if (is_string($first) || is_numeric($first)) {
                return is_string($first) ? $first : ((string) $first);
            }
        }

        return 'fix:'.$tmp;
    }

    public static function getModuleName(): string
    {
        return Str::between(static::class, 'Modules\\', '\Filament');
    }

    public function hasCombinedRelationManagerTabsWithContent(): bool
    {
        return true;
    }

    /**
     * @return class-string<Model>
     */
    public static function getModel(): string
    {
<<<<<<< .merge_file_AHYXoN
        if (static::$model !== null) {
=======
        if (null !== static::$model) {
>>>>>>> .merge_file_oDpjTE
            $res = static::$model;
            Assert::subclassOf(
                $res,
                Model::class,
                \sprintf('Class %s must extend Eloquent Model', $res),
            );

            return $res;
        }
        $moduleName = static::getModuleName();
        $modelName = Str::before(class_basename(static::class), 'Resource');
        $res = 'Modules\\'.$moduleName.'\Models\\'.$modelName;
        Assert::classExists($res, \sprintf('Model class %s does not exist', $res));
        Assert::subclassOf(
            $res,
            Model::class,
            \sprintf('Class %s must extend Eloquent Model', $res),
        );
        static::$model = $res;

        return $res;
    }

    /**
     * Non `final`: 74 Resource dei moduli lo sovrascrivono ancora, e `final` su una classe
     * base Laraxot produce un errore fatale al primo autoload della sottoclasse — non un
     * avviso dell'analizzatore, la pagina bianca. Chi migra sposta lo schema in
     * `Schemas\{Model}Form`; finche' non l'ha fatto, l'override deve restare possibile.
     * Vedi docs/wiki/rules/final-method-override.md.
     *
     * @return array<int|string, \Filament\Schemas\Components\Component>
     */
    public static function getFormSchema(): array
    {
        return static::getFormSchemaOld();
    }

    /**
     * Bridge di migrazione — schema form ancora sulla Resource.
     * La classe `{Model}Form` è **obbligatoria** ({@see static::getFormClass()}):
     * se manca si solleva errore. Old serve solo a spostare il contenuto dentro
     * `Schemas\{Model}Form::getFormSchema()`; a migrazione chiusa si rimuove.
     *
     * @return array<int|string, \Filament\Schemas\Components\Component>
     */
    public static function getFormSchemaOld(): array
    {
        return [];
    }

    /**
     * Classe Form dedicata: `{Resource}\Schemas\{Model}Form`.
     *
     * Obbligatoria. Nessun soft-skip: se non esiste → LogicException.
     *
     * @return class-string<XotBaseResourceForm>
     */
    public static function getFormClass(): string
    {
        $formClass = static::class.'\Schemas\\'.class_basename(static::getModel()).'Form';
        if (class_exists($formClass)) {
            Assert::subclassOf($formClass, XotBaseResourceForm::class);
<<<<<<< .merge_file_AHYXoN
            return $formClass;    
        }
        $class1=app(GetResourceClassNameByModelClassAction::class)->execute(static::getModel());
        $class1 = $class1.'\Schemas\\'.class_basename(static::getModel()).'Form';
        Assert::subclassOf($class1, XotBaseResourceForm::class);
=======

            return $formClass;
        }
        $class1 = app(GetResourceClassNameByModelClassAction::class)->execute(static::getModel());
        $class1 = $class1.'\Schemas\\'.class_basename(static::getModel()).'Form';
        Assert::subclassOf($class1, XotBaseResourceForm::class);

>>>>>>> .merge_file_oDpjTE
        return $class1;
    }

    final public static function form(Schema $schema): Schema
    {
        $formClass = static::getFormClass();
        $configured = $formClass::configure($schema);
<<<<<<< .merge_file_AHYXoN
        
=======

>>>>>>> .merge_file_oDpjTE
        Assert::isInstanceOf($configured, Schema::class);

        return $configured;
    }

    /**
     * Classe Table dedicata: `{Resource}\Tables\{Plural}Table`.
     *
     * Obbligatoria. Nessun soft-skip / table vuota: se non esiste → LogicException.
     *
     * @return class-string<XotBaseResourceTable>
     */
    public static function getTableClass(): string
    {
        $class = static::class.'\Tables\\'.Str::plural(class_basename(static::getModel())).'Table';
        if (class_exists($class)) {
            Assert::subclassOf($class, XotBaseResourceTable::class);
<<<<<<< .merge_file_AHYXoN
            return $class;
        }

        $class1=app(GetResourceClassNameByModelClassAction::class)->execute(static::getModel());
=======

            return $class;
        }

        $class1 = app(GetResourceClassNameByModelClassAction::class)->execute(static::getModel());
>>>>>>> .merge_file_oDpjTE
        $class1 = $class1.'\Tables\\'.Str::plural(class_basename(static::getModel())).'Table';
        Assert::subclassOf($class1, XotBaseResourceTable::class);

        return $class1;
    }

    public static function table(Table $table): Table
    {
        $class = static::getTableClass();
        $configured = $class::configure($table);
        Assert::isInstanceOf($configured, Table::class);

        return $configured;
    }

    public static function getFormSchemaColumns(): int
    {
        return 1;
    }

    /**
     * Bridge di migrazione — schema infolist ancora sulla Resource.
     * La classe `{Model}Infolist` è **obbligatoria** ({@see static::getInfolistClass()}).
     *
     * @return array<string, \Filament\Schemas\Components\Component>
     */
    public static function getInfolistSchema(): array
    {
        return [];
    }

    /**
     * Classe Infolist dedicata: `{Resource}\Schemas\{Model}Infolist`.
     *
     * Obbligatoria. Nessun soft-skip: se non esiste → LogicException.
     *
     * @return class-string<XotBaseResourceInfolist>
     */
    public static function getInfolistClass(): string
    {
        $class = static::class.'\Schemas\\'.class_basename(static::getModel()).'Infolist';
        if (class_exists($class)) {
            Assert::subclassOf($class, XotBaseResourceInfolist::class);
<<<<<<< .merge_file_AHYXoN
            return $class;    
        }
        $class1=app(GetResourceClassNameByModelClassAction::class)->execute(static::getModel());
        $class1 = $class1.'\Schemas\\'.class_basename(static::getModel()).'Infolist';
        Assert::subclassOf($class1, XotBaseResourceInfolist::class);
=======

            return $class;
        }
        $class1 = app(GetResourceClassNameByModelClassAction::class)->execute(static::getModel());
        $class1 = $class1.'\Schemas\\'.class_basename(static::getModel()).'Infolist';
        Assert::subclassOf($class1, XotBaseResourceInfolist::class);

>>>>>>> .merge_file_oDpjTE
        return $class1;
    }

    final public static function infolist(Schema $schema): Schema
    {
        $class = static::getInfolistClass();
        $configured = $class::configure($schema);
        Assert::isInstanceOf($configured, Schema::class);

        return $configured;
    }

    /**
     * @return array<string, mixed>
     */
    public static function extendTableCallback(): array
    {
        return [];
    }

    /**
     * Get form extension callbacks.
     *
     * @return array<string, mixed>
     */
    public static function extendFormCallback(): array
    {
        return [];
    }

    public static function getNavigationBadge(): ?string
    {
        try {
            $count = app(CountAction::class)->execute(static::getModel());

            return number_format($count, 0).'';
<<<<<<< .merge_file_AHYXoN
        } catch (Exception $e) {
=======
        } catch (\Exception $e) {
>>>>>>> .merge_file_oDpjTE
            return '--';
        }
    }

    /**
     * @return array<string, PageRegistration>
     */
    public static function getPages(): array
    {
        $prefix = static::class.'\Pages\\';
        $name = Str::of(class_basename(static::class))->before('Resource')->toString();
        $plural = Str::of($name)->plural()->toString();
        $index = Str::of($prefix)->append('List'.$plural)->toString();
        $create = Str::of($prefix)->append('Create'.$name.'')->toString();
        $edit = Str::of($prefix)->append('Edit'.$name.'')->toString();
        $view = Str::of($prefix)->append('View'.$name.'')->toString();

        /** @var class-string<Page> $index */
        $index = $index;
        /** @var class-string<Page> $create */
        $create = $create;
        /** @var class-string<Page> $edit */
        $edit = $edit;
        /** @var class-string<Page> $view */
        $view = $view;

        $pages = [];
        $pages['index'] = $index::route('/');
        $pages['create'] = $create::route('/create');
        $pages['edit'] = $edit::route('/{record}/edit');

        if (class_exists($view)) {
            $pages['view'] = $view::route('/{record}');
        }

        return $pages;
    }

    /**
     * @return array<class-string<RelationManager>|RelationGroup|RelationManagerConfiguration>
     */
    public static function getRelations(): array
    {
<<<<<<< .merge_file_AHYXoN
        $reflector = new ReflectionClass(static::class);
=======
        $reflector = new \ReflectionClass(static::class);
>>>>>>> .merge_file_oDpjTE
        $filename = $reflector->getFileName();
        Assert::string($filename, __FILE__.':'.__LINE__.' - '.class_basename(self::class));

        $path = Str::of($filename)
            ->before('.php')
            ->append(\DIRECTORY_SEPARATOR)
            ->append('RelationManagers')
            ->toString();

        $filesResult = glob($path.\DIRECTORY_SEPARATOR.'*RelationManager.php');

        // PHPStan: glob() with valid pattern returns array
<<<<<<< .merge_file_AHYXoN
        if ($filesResult === []) {
=======
        if ([] === $filesResult) {
>>>>>>> .merge_file_oDpjTE
            return [];
        }

        /** @var array<class-string<RelationManager>> $res */
        $res = [];
        foreach ($filesResult as $file) {
            if (! \is_string($file)) {
                continue;
            }
            $className = Str::of($file)
                ->after('RelationManagers'.\DIRECTORY_SEPARATOR)
                ->before('.php')
                ->prepend(static::class.'\RelationManagers\\')
                ->toString();

            if (class_exists($className)) {
                Assert::subclassOf($className, RelationManager::class);
                $res[] = $className;
            }
        }

        return $res;
    }

    public static function getWizardSubmitAction(): Htmlable
    {
        $submitView = 'pub_theme::filament.wizard.submit-button';
        if (! View::exists($submitView)) {
<<<<<<< .merge_file_AHYXoN
            throw new Exception("View {$submitView} does not exist");
=======
            throw new \Exception("View {$submitView} does not exist");
>>>>>>> .merge_file_oDpjTE
        }
        $render = View::make($submitView)->render();

        return new HtmlString($render);
    }

    /**
     * Get attachments schema for forms.
     *
     * @return array<int, Component>
     */
    public static function getAttachmentsSchema(): array
    {
        $model = static::getModel();
        if (! method_exists($model, 'getAttachments')) {
            return [];
        }
        $attachments = $model::getAttachments();
        if (! \is_array($attachments)) {
            return [];
        }

        /** @var array<int, string> $safeAttachments */
        $safeAttachments = array_values(array_filter($attachments, 'is_string'));

        $disk = 'attachments';

        /** @var array<int, Component> $schema */
        $schema = app(GetAttachmentsSchemaAction::class)->execute($safeAttachments, $disk);

        return $schema;
    }

    protected static function getKeyTrans(string $key): string
    {
        /** @var string */
        $transKey = app(GetTransKeyAction::class)->execute(static::class);

        $key = $transKey.'.'.$key;
        $key = Str::of($key)->replace('.cluster.pages.', '.')->toString();
        if (Str::startsWith($key, 'edit_')) {
            $key = Str::after($key, 'edit_');
        }
        if (Str::endsWith($key, '_widget')) {
            $key = Str::beforeLast($key, '_widget');
        }

        return $key;
    }

    protected static function getStepByName(string $name): Step
    {
        $methodName = Str::of($name)
            ->snake()
            ->studly()
            ->prepend('get')
            ->append('Schema')
            ->toString();

        if (method_exists(static::class, $methodName)) {
            $schemaResult = static::$methodName();
            /** @var array<Htmlable|string> $schemaComponents */
            $schemaComponents = \is_array($schemaResult) ? array_values($schemaResult) : [];

            return Step::make($name)->schema($schemaComponents);
        }

        return Step::make($name)->schema([]);
    }
<<<<<<< .merge_file_AHYXoN
}
=======
}
>>>>>>> .merge_file_oDpjTE
