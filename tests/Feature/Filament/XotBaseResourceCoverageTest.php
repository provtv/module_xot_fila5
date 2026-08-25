<?php

declare(strict_types=1);

use Filament\Schemas\Components\Wizard\Step;
use Illuminate\Support\HtmlString;
use Modules\Media\Actions\GetAttachmentsSchemaAction;
use Modules\Xot\Actions\GetTransKeyAction;
use Modules\Xot\Actions\ModelClass\CountAction;
use Modules\Xot\Filament\Resources\XotBaseResource;
use Modules\Xot\Tests\Fixtures\Filament\Resources\ProbeResource;
use Modules\Xot\Tests\Fixtures\Models\Probe;
use Modules\Xot\Tests\Fixtures\Models\ProbeBadAttachments;
use Modules\Xot\Tests\Fixtures\Models\ProbeGoodAttachments;
use Modules\Xot\Tests\TestCase;
use PHPUnit\Framework\Assert;

use function Safe\file_put_contents;
use function Safe\mkdir;

uses(TestCase::class);

it('covers model resolution and model cache', function (): void {
    ProbeResource::resetModelCache();

<<<<<<< HEAD
   Assert::assertSame(Probe::class, ProbeResource::getModel());
=======
    Assert::assertSame(Probe::class, ProbeResource::getModel());
>>>>>>> laraxot/dev
});

it('covers default relation discovery with missing relation manager classes', function (): void {
    Assert::assertSame([], ProbeResource::getRelations());
});

it('covers default page discovery including optional view page', function (): void {
    $pages = ProbeResource::getPages();

<<<<<<< HEAD
   Assert::assertArrayHasKey('index', $pages);
=======
    Assert::assertArrayHasKey('index', $pages);
>>>>>>> laraxot/dev
    Assert::assertArrayHasKey('create', $pages);
    Assert::assertArrayHasKey('edit', $pages);
    Assert::assertArrayHasKey('view', $pages);
});

it('covers translation helper key normalization', function (): void {
    app()->instance(GetTransKeyAction::class, new class {
        public function execute(string $class): string
        {
            return 'probe.cluster.pages.item_widget';
        }
    });

<<<<<<< HEAD
   Assert::assertSame('probe.item_widget.title', ProbeResource::callGetKeyTrans('title'));
=======
    Assert::assertSame('probe.item_widget.title', ProbeResource::callGetKeyTrans('title'));
>>>>>>> laraxot/dev
});

it('covers translation helper edit and widget normalization branches', function (): void {
    app()->instance(GetTransKeyAction::class, new class {
        public function execute(string $class): string
        {
            return 'edit_';
        }
    });

<<<<<<< HEAD
   Assert::assertSame('.name', ProbeResource::callGetKeyTrans('name'));
=======
    Assert::assertSame('.name', ProbeResource::callGetKeyTrans('name'));
>>>>>>> laraxot/dev
    app()->instance(GetTransKeyAction::class, new class {
        public function execute(string $class): string
        {
            return 'probe';
        }
    });

<<<<<<< HEAD
   Assert::assertSame('probe.title', ProbeResource::callGetKeyTrans('title_widget'));
=======
    Assert::assertSame('probe.title', ProbeResource::callGetKeyTrans('title_widget'));
>>>>>>> laraxot/dev
});

it('covers translation helper string path and missing key fallback', function (): void {
    app()->instance(GetTransKeyAction::class, new class {
        public function execute(string $class): string
        {
            return 'probe.messages';
        }
    });

    app('translator')->addLines(['probe.messages.ok' => 'Done'], app()->getLocale());

<<<<<<< HEAD
   Assert::assertSame('Done', ProbeResource::trans('ok'));
=======
    Assert::assertSame('Done', ProbeResource::trans('ok'));
>>>>>>> laraxot/dev
    Assert::assertSame('probe.messages.missing', ProbeResource::trans('missing'));
});

it('covers translation helper array and fix fallback branches', function (): void {
    app()->instance(GetTransKeyAction::class, new class {
        public function execute(string $class): string
        {
            return 'probe.arr';
        }
    });

    app('translator')->addLines([
        'probe.arr.scalar' => [123],
        'probe.arr.nonscalar' => [['x' => 1]],
    ], app()->getLocale());

<<<<<<< HEAD
   Assert::assertSame('123', ProbeResource::trans('scalar'));
=======
    Assert::assertSame('123', ProbeResource::trans('scalar'));
>>>>>>> laraxot/dev
    Assert::assertSame('fix:probe.arr.nonscalar', ProbeResource::trans('nonscalar'));
});

it('covers translation helper exception branch', function (): void {
    app()->instance(GetTransKeyAction::class, new class {
        public function execute(string $class): string
        {
            return 'probe.exceptions';
        }
    });

<<<<<<< HEAD
   $threwException = false;
=======
    $threwException = false;
>>>>>>> laraxot/dev
    try {
        ProbeResource::trans('missing', true);
    } catch (Exception $e) {
        $threwException = true;
    }
    Assert::assertTrue($threwException);
});

it('covers navigation badge success and fallback', function (): void {
    app()->instance(CountAction::class, new class {
        public function execute(string $class): int
        {
            return 42;
        }
    });

<<<<<<< HEAD
   Assert::assertSame('42', ProbeResource::getNavigationBadge());
=======
    Assert::assertSame('42', ProbeResource::getNavigationBadge());
>>>>>>> laraxot/dev
    app()->instance(CountAction::class, new class {
        public function execute(string $class): int
        {
            throw new Exception('boom');
        }
    });

    Assert::assertSame('--', ProbeResource::getNavigationBadge());
});

it('covers get attachments schema branches', function (): void {
    $resourceNoAttachments = new class extends XotBaseResource {
        protected static ?string $model = Probe::class;

<<<<<<< HEAD
       public static function getFormSchemaOld(): array
=======
        public static function getFormSchemaOld(): array
>>>>>>> laraxot/dev
        {
            return [];
        }
    };

<<<<<<< HEAD
   Assert::assertSame([], $resourceNoAttachments::getAttachmentsSchema());
=======
    Assert::assertSame([], $resourceNoAttachments::getAttachmentsSchema());
>>>>>>> laraxot/dev
    if (! class_exists('Modules\\Xot\\Tests\\Fixtures\\Models\\ProbeBadAttachments')) {
        eval(' class ProbeBadAttachments extends \\Illuminate\\Database\\Eloquent\\Model { public static function getAttachments(): string { return "invalid"; } }');
    }

    $resourceBadAttachments = new class extends XotBaseResource {
        protected static ?string $model = ProbeBadAttachments::class;

<<<<<<< HEAD
       public static function getFormSchemaOld(): array
=======
        public static function getFormSchemaOld(): array
>>>>>>> laraxot/dev
        {
            return [];
        }
    };

<<<<<<< HEAD
   Assert::assertSame([], $resourceBadAttachments::getAttachmentsSchema());
=======
    Assert::assertSame([], $resourceBadAttachments::getAttachmentsSchema());
>>>>>>> laraxot/dev
    if (! class_exists('Modules\\Xot\\Tests\\Fixtures\\Models\\ProbeGoodAttachments')) {
        eval(' class ProbeGoodAttachments extends \\Illuminate\\Database\\Eloquent\\Model { public static function getAttachments(): array { return ["one", 7, "two"]; } }');
    }

    app()->instance(GetAttachmentsSchemaAction::class, new class {
<<<<<<< HEAD
       /**
=======
        /**
>>>>>>> laraxot/dev
         * @param string[] $attachments
         *
         * @return string[]
         */
        public function execute(array $attachments, string $disk): array
        {
            if ($attachments !== ['one', 'two'] || 'attachments' !== $disk) {
                throw new RuntimeException('unexpected attachments payload');
            }

            return ['schema'];
        }
    });

    $resourceGoodAttachments = new class extends XotBaseResource {
        protected static ?string $model = ProbeGoodAttachments::class;

<<<<<<< HEAD
       public static function getFormSchemaOld(): array
=======
        public static function getFormSchemaOld(): array
>>>>>>> laraxot/dev
        {
            return [];
        }
    };

<<<<<<< HEAD
   Assert::assertSame(['schema'], $resourceGoodAttachments::getAttachmentsSchema());
=======
    Assert::assertSame(['schema'], $resourceGoodAttachments::getAttachmentsSchema());
>>>>>>> laraxot/dev
});

it('covers wizard submit action success and failure paths', function (): void {
    $tmpViewDir = sys_get_temp_dir().'/xot-resource-view-'.uniqid('', true);
    $viewPath = $tmpViewDir.'/filament/wizard';
    mkdir($viewPath, 0777, true);
    file_put_contents($viewPath.'/submit-button.blade.php', '<button>submit</button>');

    view()->addNamespace('pub_theme', $tmpViewDir);

    $html = ProbeResource::getWizardSubmitAction();
<<<<<<< HEAD
   Assert::assertInstanceOf(HtmlString::class, $html);
=======
    Assert::assertInstanceOf(HtmlString::class, $html);
>>>>>>> laraxot/dev
    Assert::assertStringContainsString('submit', (string) $html->toHtml());
});

it('covers step builder branches', function (): void {
    Assert::assertInstanceOf(Step::class, ProbeResource::callGetStepByName('missing_step'));
    Assert::assertInstanceOf(Step::class, ProbeResource::callGetStepByName('custom_step'));
});

it('covers simple base helpers', function (): void {
    $resource = new ProbeResource();

<<<<<<< HEAD
   Assert::assertSame([], ProbeResource::getInfolistSchema());
=======
    Assert::assertSame([], ProbeResource::getInfolistSchema());
>>>>>>> laraxot/dev
    Assert::assertSame([], ProbeResource::extendTableCallback());
    Assert::assertSame([], ProbeResource::extendFormCallback());
    Assert::assertStringStartsWith('Xot', ProbeResource::getModuleName());
    Assert::assertTrue($resource->hasCombinedRelationManagerTabsWithContent());
    Assert::assertGreaterThan(0, ProbeResource::getFormSchemaColumns());
});
