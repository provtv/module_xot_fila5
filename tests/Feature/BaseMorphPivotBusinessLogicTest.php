<?php

declare(strict_types=1);

namespace Modules\Xot\Tests\Feature;

use Illuminate\Database\Eloquent\Relations\Pivot;
<<<<<<< HEAD
use Modules\Xot\Tests\Fixtures\Models\TestConcreteMorphPivot;
use Modules\Xot\Tests\TestCase;
use PHPUnit\Framework\Assert;

uses(TestCase::class);

describe('Base Morph Pivot Business Logic', function (): void {
    test('it extends pivot class', function (): void {
        // Arrange & Act
        $pivot = new TestConcreteMorphPivot;

        // Assert
        Assert::assertInstanceOf(Pivot::class, $pivot);
    });

    test('it can manage morph type', function (): void {
        // Arrange
        $pivot = new TestConcreteMorphPivot;
        $pivot->setAttribute('morph_type', 'App\Models\User');

        // Act
        $morphType = $pivot->getAttribute('morph_type');

        // Assert
        Assert::assertEquals('App\Models\User', $morphType);
    });

    test('it can manage morph id', function (): void {
        // Arrange
        $pivot = new TestConcreteMorphPivot;
        $pivot->setAttribute('morph_id', 123);

        // Act
        $morphId = $pivot->getAttribute('morph_id');

        // Assert
        Assert::assertEquals(123, $morphId);
    });

    test('it can manage related type', function (): void {
        // Arrange
        $pivot = new TestConcreteMorphPivot;
        $pivot->setAttribute('related_type', 'App\Models\Post');

        // Act
        $relatedType = $pivot->getAttribute('related_type');

        // Assert
        Assert::assertEquals('App\Models\Post', $relatedType);
    });

    test('it can manage related id', function (): void {
        // Arrange
        $pivot = new TestConcreteMorphPivot;
        $pivot->setAttribute('related_id', 456);

        // Act
        $relatedId = $pivot->getAttribute('related_id');

        // Assert
        Assert::assertEquals(456, $relatedId);
    });

    test('it can manage pivot attributes', function (): void {
        // Arrange
        $pivot = new TestConcreteMorphPivot;
=======
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Xot\Models\BaseMorphPivot;
use Tests\TestCase;

class BaseMorphPivotBusinessLogicTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_extends_pivot_class(): void
    {
        // Arrange & Act
        $pivot = new BaseMorphPivot();

        // Assert
        $this->assertInstanceOf(Pivot::class, $pivot);
    }

    /** @test */
    public function it_can_manage_morph_type(): void
    {
        // Arrange
        $pivot = new BaseMorphPivot();
        $pivot->morph_type = 'App\Models\User';

        // Act
        $morphType = $pivot->morph_type;

        // Assert
        $this->assertEquals('App\Models\User', $morphType);
    }

    /** @test */
    public function it_can_manage_morph_id(): void
    {
        // Arrange
        $pivot = new BaseMorphPivot();
        $pivot->morph_id = 123;

        // Act
        $morphId = $pivot->morph_id;

        // Assert
        $this->assertEquals(123, $morphId);
    }

    /** @test */
    public function it_can_manage_related_type(): void
    {
        // Arrange
        $pivot = new BaseMorphPivot();
        $pivot->related_type = 'App\Models\Post';

        // Act
        $relatedType = $pivot->related_type;

        // Assert
        $this->assertEquals('App\Models\Post', $relatedType);
    }

    /** @test */
    public function it_can_manage_related_id(): void
    {
        // Arrange
        $pivot = new BaseMorphPivot();
        $pivot->related_id = 456;

        // Act
        $relatedId = $pivot->related_id;

        // Assert
        $this->assertEquals(456, $relatedId);
    }

    /** @test */
    public function it_can_manage_pivot_attributes(): void
    {
        // Arrange
        $pivot = new BaseMorphPivot();
>>>>>>> laraxot/master
        $pivot->setAttribute('custom_field', 'custom_value');
        $pivot->setAttribute('numeric_field', 42);

        // Act
<<<<<<< HEAD
        /** @var string $customField */
        $customField = $pivot->getAttribute('custom_field');
        /** @var int $numericField */
        $numericField = $pivot->getAttribute('numeric_field');

        // Assert
        Assert::assertEquals('custom_value', $customField);
        Assert::assertEquals(42, $numericField);
    });

    test('it can manage timestamps', function (): void {
        // Arrange
        $pivot = new TestConcreteMorphPivot;
        $now = now();
        $pivot->setAttribute('created_at', $now);
        $pivot->setAttribute('updated_at', $now);

        // Act
        $createdAt = $pivot->getAttribute('created_at');
        $updatedAt = $pivot->getAttribute('updated_at');

        // Assert
        Assert::assertEquals($now, $createdAt);
        Assert::assertEquals($now, $updatedAt);
    });

    test('it can manage soft deletes', function (): void {
        // Arrange
        $pivot = new TestConcreteMorphPivot;
        $deletedAt = now();
        $pivot->setAttribute('deleted_at', $deletedAt);

        // Act
        $pivotDeletedAt = $pivot->getAttribute('deleted_at');

        // Assert
        Assert::assertEquals($deletedAt, $pivotDeletedAt);
    });

    test('it can manage tenant id', function (): void {
        // Arrange
        $pivot = new TestConcreteMorphPivot;
        $pivot->setAttribute('tenant_id', 789);

        // Act
        $tenantId = $pivot->getAttribute('tenant_id');

        // Assert
        Assert::assertEquals(789, $tenantId);
    });

    test('it can manage user id', function (): void {
        // Arrange
        $pivot = new TestConcreteMorphPivot;
        $pivot->setAttribute('user_id', 101);

        // Act
        $userId = $pivot->getAttribute('user_id');

        // Assert
        Assert::assertEquals(101, $userId);
    });

    test('it can manage metadata', function (): void {
=======
        $customField = $pivot->getAttribute('custom_field');
        $numericField = $pivot->getAttribute('numeric_field');

        // Assert
        $this->assertEquals('custom_value', $customField);
        $this->assertEquals(42, $numericField);
    }

    /** @test */
    public function it_can_manage_timestamps(): void
    {
        // Arrange
        $pivot = new BaseMorphPivot();
        $now = now();
        $pivot->created_at = $now;
        $pivot->updated_at = $now;

        // Act
        $createdAt = $pivot->created_at;
        $updatedAt = $pivot->updated_at;

        // Assert
        $this->assertEquals($now, $createdAt);
        $this->assertEquals($now, $updatedAt);
    }

    /** @test */
    public function it_can_manage_soft_deletes(): void
    {
        // Arrange
        $pivot = new BaseMorphPivot();
        $deletedAt = now();
        $pivot->deleted_at = $deletedAt;

        // Act
        $pivotDeletedAt = $pivot->deleted_at;

        // Assert
        $this->assertEquals($deletedAt, $pivotDeletedAt);
    }

    /** @test */
    public function it_can_manage_tenant_id(): void
    {
        // Arrange
        $pivot = new BaseMorphPivot();
        $pivot->tenant_id = 789;

        // Act
        $tenantId = $pivot->tenant_id;

        // Assert
        $this->assertEquals(789, $tenantId);
    }

    /** @test */
    public function it_can_manage_user_id(): void
    {
        // Arrange
        $pivot = new BaseMorphPivot();
        $pivot->user_id = 101;

        // Act
        $userId = $pivot->user_id;

        // Assert
        $this->assertEquals(101, $userId);
    }

    /** @test */
    public function it_can_manage_metadata(): void
    {
>>>>>>> laraxot/master
        // Arrange
        $metadata = [
            'source' => 'api',
            'ip_address' => '192.168.1.1',
            'user_agent' => 'Test Browser',
            'session_id' => 'session123',
        ];

<<<<<<< HEAD
        $pivot = new TestConcreteMorphPivot;
        $pivot->setAttribute('metadata', $metadata);

        // Act
        /** @var array<string, string> $pivotMetadata */
        $pivotMetadata = $pivot->getAttribute('metadata');

        // Assert
        Assert::assertNotEmpty($pivotMetadata);
        Assert::assertEquals('api', $pivotMetadata['source']);
        Assert::assertEquals('192.168.1.1', $pivotMetadata['ip_address']);
        Assert::assertEquals('Test Browser', $pivotMetadata['user_agent']);
        Assert::assertEquals('session123', $pivotMetadata['session_id']);
    });

    test('it can manage extra data', function (): void {
=======
        $pivot = new BaseMorphPivot();
        $pivot->metadata = $metadata;

        // Act
        $pivotMetadata = $pivot->metadata;

        // Assert
        $this->assertIsArray($pivotMetadata);
        $this->assertEquals('api', $pivotMetadata['source']);
        $this->assertEquals('192.168.1.1', $pivotMetadata['ip_address']);
        $this->assertEquals('Test Browser', $pivotMetadata['user_agent']);
        $this->assertEquals('session123', $pivotMetadata['session_id']);
    }

    /** @test */
    public function it_can_manage_extra_data(): void
    {
>>>>>>> laraxot/master
        // Arrange
        $extraData = [
            'field1' => 'value1',
            'field2' => 'value2',
            'nested' => [
                'key' => 'value',
            ],
        ];

<<<<<<< HEAD
        $pivot = new TestConcreteMorphPivot;
        $pivot->setAttribute('extra_data', $extraData);

        // Act
        /** @var array<string, mixed> $pivotExtraData */
        $pivotExtraData = $pivot->getAttribute('extra_data');

        // Assert
        Assert::assertNotEmpty($pivotExtraData);
        Assert::assertEquals('value1', $pivotExtraData['field1']);
        Assert::assertEquals('value2', $pivotExtraData['field2']);
        /** @var array<string, string> $nested */
        $nested = $pivotExtraData['nested'];
        Assert::assertEquals('value', $nested['key']);
    });

    test('it can manage status', function (): void {
        // Arrange
        $pivot = new TestConcreteMorphPivot;
        $pivot->setAttribute('status', 'active');

        // Act
        /** @var string $status */
        $status = $pivot->getAttribute('status');

        // Assert
        Assert::assertEquals('active', $status);
    });

    test('it can manage priority', function (): void {
        // Arrange
        $pivot = new TestConcreteMorphPivot;
        $pivot->setAttribute('priority', 5);

        // Act
        /** @var int $priority */
        $priority = $pivot->getAttribute('priority');

        // Assert
        Assert::assertEquals(5, $priority);
    });

    test('it can manage sort order', function (): void {
        // Arrange
        $pivot = new TestConcreteMorphPivot;
        $pivot->setAttribute('sort_order', 10);

        // Act
        /** @var int $sortOrder */
        $sortOrder = $pivot->getAttribute('sort_order');

        // Assert
        Assert::assertEquals(10, $sortOrder);
    });

    test('it can manage expires at', function (): void {
        // Arrange
        $pivot = new TestConcreteMorphPivot;
        $expiresAt = now()->addDays(30);
        $pivot->setAttribute('expires_at', $expiresAt);

        // Act
        $pivotExpiresAt = $pivot->getAttribute('expires_at');

        // Assert
        Assert::assertEquals($expiresAt, $pivotExpiresAt);
    });

    test('it can manage starts at', function (): void {
        // Arrange
        $pivot = new TestConcreteMorphPivot;
        $startsAt = now()->addHours(2);
        $pivot->setAttribute('starts_at', $startsAt);

        // Act
        $pivotStartsAt = $pivot->getAttribute('starts_at');

        // Assert
        Assert::assertEquals($startsAt, $pivotStartsAt);
    });

    test('it can manage ends at', function (): void {
        // Arrange
        $pivot = new TestConcreteMorphPivot;
        $endsAt = now()->addDays(7);
        $pivot->setAttribute('ends_at', $endsAt);

        // Act
        $pivotEndsAt = $pivot->getAttribute('ends_at');

        // Assert
        Assert::assertEquals($endsAt, $pivotEndsAt);
    });

    test('it can manage is active', function (): void {
        // Arrange
        $pivot = new TestConcreteMorphPivot;
        $pivot->setAttribute('is_active', true);

        // Act
        $isActive = $pivot->getAttribute('is_active');

        // Assert
        Assert::assertTrue((bool) $isActive);

        // Act - Deactivate
        $pivot->setAttribute('is_active', false);

        // Assert
        Assert::assertFalse((bool) $pivot->getAttribute('is_active'));
    });

    test('it can manage is public', function (): void {
        // Arrange
        $pivot = new TestConcreteMorphPivot;
        $pivot->setAttribute('is_public', false);

        // Act
        $isPublic = $pivot->getAttribute('is_public');

        // Assert
        Assert::assertFalse((bool) $isPublic);

        // Act - Make public
        $pivot->setAttribute('is_public', true);

        // Assert
        Assert::assertTrue((bool) $pivot->getAttribute('is_public'));
    });

    test('it can manage is featured', function (): void {
        // Arrange
        $pivot = new TestConcreteMorphPivot;
        $pivot->setAttribute('is_featured', false);

        // Act
        $isFeatured = $pivot->getAttribute('is_featured');

        // Assert
        Assert::assertFalse((bool) $isFeatured);

        // Act - Make featured
        $pivot->setAttribute('is_featured', true);

        // Assert
        Assert::assertTrue((bool) $pivot->getAttribute('is_featured'));
    });

    test('it can manage tags', function (): void {
        // Arrange
        $tags = ['tag1', 'tag2', 'important'];

        $pivot = new TestConcreteMorphPivot;
        $pivot->setAttribute('tags', $tags);

        // Act
        /** @var array<int, string> $pivotTags */
        $pivotTags = $pivot->getAttribute('tags');

        // Assert
        Assert::assertNotEmpty($pivotTags);
        Assert::assertContains('tag1', $pivotTags);
        Assert::assertContains('tag2', $pivotTags);
        Assert::assertContains('important', $pivotTags);
        Assert::assertCount(3, $pivotTags);
    });

    test('it can manage categories', function (): void {
        // Arrange
        $categories = ['category1', 'category2'];

        $pivot = new TestConcreteMorphPivot;
        $pivot->setAttribute('categories', $categories);

        // Act
        /** @var array<int, string> $pivotCategories */
        $pivotCategories = $pivot->getAttribute('categories');

        // Assert
        Assert::assertNotEmpty($pivotCategories);
        Assert::assertContains('category1', $pivotCategories);
        Assert::assertContains('category2', $pivotCategories);
        Assert::assertCount(2, $pivotCategories);
    });

    test('it can manage permissions', function (): void {
=======
        $pivot = new BaseMorphPivot();
        $pivot->extra_data = $extraData;

        // Act
        $pivotExtraData = $pivot->extra_data;

        // Assert
        $this->assertIsArray($pivotExtraData);
        $this->assertEquals('value1', $pivotExtraData['field1']);
        $this->assertEquals('value2', $pivotExtraData['field2']);
        $this->assertEquals('value', $pivotExtraData['nested']['key']);
    }

    /** @test */
    public function it_can_manage_status(): void
    {
        // Arrange
        $pivot = new BaseMorphPivot();
        $pivot->status = 'active';

        // Act
        $status = $pivot->status;

        // Assert
        $this->assertEquals('active', $status);
    }

    /** @test */
    public function it_can_manage_priority(): void
    {
        // Arrange
        $pivot = new BaseMorphPivot();
        $pivot->priority = 5;

        // Act
        $priority = $pivot->priority;

        // Assert
        $this->assertEquals(5, $priority);
    }

    /** @test */
    public function it_can_manage_sort_order(): void
    {
        // Arrange
        $pivot = new BaseMorphPivot();
        $pivot->sort_order = 10;

        // Act
        $sortOrder = $pivot->sort_order;

        // Assert
        $this->assertEquals(10, $sortOrder);
    }

    /** @test */
    public function it_can_manage_expires_at(): void
    {
        // Arrange
        $pivot = new BaseMorphPivot();
        $expiresAt = now()->addDays(30);
        $pivot->expires_at = $expiresAt;

        // Act
        $pivotExpiresAt = $pivot->expires_at;

        // Assert
        $this->assertEquals($expiresAt, $pivotExpiresAt);
    }

    /** @test */
    public function it_can_manage_starts_at(): void
    {
        // Arrange
        $pivot = new BaseMorphPivot();
        $startsAt = now()->addHours(2);
        $pivot->starts_at = $startsAt;

        // Act
        $pivotStartsAt = $pivot->starts_at;

        // Assert
        $this->assertEquals($startsAt, $pivotStartsAt);
    }

    /** @test */
    public function it_can_manage_ends_at(): void
    {
        // Arrange
        $pivot = new BaseMorphPivot();
        $endsAt = now()->addDays(7);
        $pivot->ends_at = $endsAt;

        // Act
        $pivotEndsAt = $pivot->ends_at;

        // Assert
        $this->assertEquals($endsAt, $pivotEndsAt);
    }

    /** @test */
    public function it_can_manage_is_active(): void
    {
        // Arrange
        $pivot = new BaseMorphPivot();
        $pivot->is_active = true;

        // Act
        $isActive = $pivot->is_active;

        // Assert
        $this->assertTrue($isActive);

        // Act - Deactivate
        $pivot->is_active = false;

        // Assert
        $this->assertFalse($pivot->is_active);
    }

    /** @test */
    public function it_can_manage_is_public(): void
    {
        // Arrange
        $pivot = new BaseMorphPivot();
        $pivot->is_public = false;

        // Act
        $isPublic = $pivot->is_public;

        // Assert
        $this->assertFalse($isPublic);

        // Act - Make public
        $pivot->is_public = true;

        // Assert
        $this->assertTrue($pivot->is_public);
    }

    /** @test */
    public function it_can_manage_is_featured(): void
    {
        // Arrange
        $pivot = new BaseMorphPivot();
        $pivot->is_featured = false;

        // Act
        $isFeatured = $pivot->is_featured;

        // Assert
        $this->assertFalse($isFeatured);

        // Act - Make featured
        $pivot->is_featured = true;

        // Assert
        $this->assertTrue($pivot->is_featured);
    }

    /** @test */
    public function it_can_manage_tags(): void
    {
        // Arrange
        $tags = ['tag1', 'tag2', 'important'];

        $pivot = new BaseMorphPivot();
        $pivot->tags = $tags;

        // Act
        $pivotTags = $pivot->tags;

        // Assert
        $this->assertIsArray($pivotTags);
        $this->assertContains('tag1', $pivotTags);
        $this->assertContains('tag2', $pivotTags);
        $this->assertContains('important', $pivotTags);
        $this->assertCount(3, $pivotTags);
    }

    /** @test */
    public function it_can_manage_categories(): void
    {
        // Arrange
        $categories = ['category1', 'category2'];

        $pivot = new BaseMorphPivot();
        $pivot->categories = $categories;

        // Act
        $pivotCategories = $pivot->categories;

        // Assert
        $this->assertIsArray($pivotCategories);
        $this->assertContains('category1', $pivotCategories);
        $this->assertContains('category2', $pivotCategories);
        $this->assertCount(2, $pivotCategories);
    }

    /** @test */
    public function it_can_manage_permissions(): void
    {
>>>>>>> laraxot/master
        // Arrange
        $permissions = [
            'read' => true,
            'write' => false,
            'delete' => false,
        ];

<<<<<<< HEAD
        $pivot = new TestConcreteMorphPivot;
        $pivot->setAttribute('permissions', $permissions);

        // Act
        /** @var array<string, bool> $pivotPermissions */
        $pivotPermissions = $pivot->getAttribute('permissions');

        // Assert
        Assert::assertNotEmpty($pivotPermissions);
        Assert::assertTrue($pivotPermissions['read']);
        Assert::assertFalse($pivotPermissions['write']);
        Assert::assertFalse($pivotPermissions['delete']);
    });

    test('it can manage settings', function (): void {
=======
        $pivot = new BaseMorphPivot();
        $pivot->permissions = $permissions;

        // Act
        $pivotPermissions = $pivot->permissions;

        // Assert
        $this->assertIsArray($pivotPermissions);
        $this->assertTrue($pivotPermissions['read']);
        $this->assertFalse($pivotPermissions['write']);
        $this->assertFalse($pivotPermissions['delete']);
    }

    /** @test */
    public function it_can_manage_settings(): void
    {
>>>>>>> laraxot/master
        // Arrange
        $settings = [
            'notifications' => true,
            'auto_save' => false,
            'timeout' => 30,
        ];

<<<<<<< HEAD
        $pivot = new TestConcreteMorphPivot;
        $pivot->setAttribute('settings', $settings);

        // Act
        /** @var array<string, mixed> $pivotSettings */
        $pivotSettings = $pivot->getAttribute('settings');

        // Assert
        Assert::assertNotEmpty($pivotSettings);
        Assert::assertTrue($pivotSettings['notifications']);
        Assert::assertFalse($pivotSettings['auto_save']);
        Assert::assertEquals(30, $pivotSettings['timeout']);
    });

    test('it can manage notes', function (): void {
        // Arrange
        $notes = 'This is a test note for the pivot relationship';

        $pivot = new TestConcreteMorphPivot;
        $pivot->setAttribute('notes', $notes);

        // Act
        $pivotNotes = $pivot->getAttribute('notes');

        // Assert
        Assert::assertEquals($notes, $pivotNotes);
    });

    test('it can manage description', function (): void {
        // Arrange
        $description = 'Test description for pivot relationship';

        $pivot = new TestConcreteMorphPivot;
        $pivot->setAttribute('description', $description);

        // Act
        $pivotDescription = $pivot->getAttribute('description');

        // Assert
        Assert::assertEquals($description, $pivotDescription);
    });

    test('it can manage url', function (): void {
        // Arrange
        $url = 'https://example.com/pivot/123';

        $pivot = new TestConcreteMorphPivot;
        $pivot->setAttribute('url', $url);

        // Act
        $pivotUrl = $pivot->getAttribute('url');

        // Assert
        Assert::assertEquals($url, $pivotUrl);
    });

    test('it can manage image url', function (): void {
        // Arrange
        $imageUrl = 'https://example.com/images/pivot.jpg';

        $pivot = new TestConcreteMorphPivot;
        $pivot->setAttribute('image_url', $imageUrl);

        // Act
        $pivotImageUrl = $pivot->getAttribute('image_url');

        // Assert
        Assert::assertEquals($imageUrl, $pivotImageUrl);
    });

    test('it can manage external id', function (): void {
        // Arrange
        $externalId = 'ext_12345';

        $pivot = new TestConcreteMorphPivot;
        $pivot->setAttribute('external_id', $externalId);

        // Act
        $pivotExternalId = $pivot->getAttribute('external_id');

        // Assert
        Assert::assertEquals($externalId, $pivotExternalId);
    });

    test('it can manage source', function (): void {
        // Arrange
        $source = 'api_import';

        $pivot = new TestConcreteMorphPivot;
        $pivot->setAttribute('source', $source);

        // Act
        $pivotSource = $pivot->getAttribute('source');

        // Assert
        Assert::assertEquals($source, $pivotSource);
    });

    test('it can manage version', function (): void {
        // Arrange
        $version = '1.2.3';

        $pivot = new TestConcreteMorphPivot;
        $pivot->setAttribute('version', $version);

        // Act
        $pivotVersion = $pivot->getAttribute('version');

        // Assert
        Assert::assertEquals($version, $pivotVersion);
    });

    test('it can manage hash', function (): void {
        // Arrange
        $hash = 'abc123def456';

        $pivot = new TestConcreteMorphPivot;
        $pivot->setAttribute('hash', $hash);

        // Act
        $pivotHash = $pivot->getAttribute('hash');

        // Assert
        Assert::assertEquals($hash, $pivotHash);
    });

    test('it can manage checksum', function (): void {
        // Arrange
        $checksum = 'sha256:abc123def456';

        $pivot = new TestConcreteMorphPivot;
        $pivot->setAttribute('checksum', $checksum);

        // Act
        $pivotChecksum = $pivot->getAttribute('checksum');

        // Assert
        Assert::assertEquals($checksum, $pivotChecksum);
    });

    test('it can manage size', function (): void {
        // Arrange
        $size = 1024;

        $pivot = new TestConcreteMorphPivot;
        $pivot->setAttribute('size', $size);

        // Act
        /** @var int $pivotSize */
        $pivotSize = $pivot->getAttribute('size');

        // Assert
        Assert::assertEquals($size, $pivotSize);
    });

    test('it can manage mime type', function (): void {
        // Arrange
        $mimeType = 'application/json';

        $pivot = new TestConcreteMorphPivot;
        $pivot->setAttribute('mime_type', $mimeType);

        // Act
        $pivotMimeType = $pivot->getAttribute('mime_type');

        // Assert
        Assert::assertEquals($mimeType, $pivotMimeType);
    });

    test('it can manage encoding', function (): void {
        // Arrange
        $encoding = 'UTF-8';

        $pivot = new TestConcreteMorphPivot;
        $pivot->setAttribute('encoding', $encoding);

        // Act
        $pivotEncoding = $pivot->getAttribute('encoding');

        // Assert
        Assert::assertEquals($encoding, $pivotEncoding);
    });

    test('it can manage language', function (): void {
        // Arrange
        $language = 'en';

        $pivot = new TestConcreteMorphPivot;
        $pivot->setAttribute('language', $language);

        // Act
        $pivotLanguage = $pivot->getAttribute('language');

        // Assert
        Assert::assertEquals($language, $pivotLanguage);
    });

    test('it can manage locale', function (): void {
        // Arrange
        $locale = 'en_US';

        $pivot = new TestConcreteMorphPivot;
        $pivot->setAttribute('locale', $locale);

        // Act
        $pivotLocale = $pivot->getAttribute('locale');

        // Assert
        Assert::assertEquals($locale, $pivotLocale);
    });

    test('it can manage timezone', function (): void {
        // Arrange
        $timezone = 'Europe/Rome';

        $pivot = new TestConcreteMorphPivot;
        $pivot->setAttribute('timezone', $timezone);

        // Act
        $pivotTimezone = $pivot->getAttribute('timezone');

        // Assert
        Assert::assertEquals($timezone, $pivotTimezone);
    });

    test('it can manage currency', function (): void {
        // Arrange
        $currency = 'EUR';

        $pivot = new TestConcreteMorphPivot;
        $pivot->setAttribute('currency', $currency);

        // Act
        $pivotCurrency = $pivot->getAttribute('currency');

        // Assert
        Assert::assertEquals($currency, $pivotCurrency);
    });

    test('it can manage decimal places', function (): void {
        // Arrange
        $decimalPlaces = 2;

        $pivot = new TestConcreteMorphPivot;
        $pivot->setAttribute('decimal_places', $decimalPlaces);

        // Act
        /** @var int $pivotDecimalPlaces */
        $pivotDecimalPlaces = $pivot->getAttribute('decimal_places');

        // Assert
        Assert::assertEquals($decimalPlaces, $pivotDecimalPlaces);
    });

    test('it can manage rounding mode', function (): void {
        // Arrange
        $roundingMode = 'half_up';

        $pivot = new TestConcreteMorphPivot;
        $pivot->setAttribute('rounding_mode', $roundingMode);

        // Act
        $pivotRoundingMode = $pivot->getAttribute('rounding_mode');

        // Assert
        Assert::assertEquals($roundingMode, $pivotRoundingMode);
    });
});
=======
        $pivot = new BaseMorphPivot();
        $pivot->settings = $settings;

        // Act
        $pivotSettings = $pivot->settings;

        // Assert
        $this->assertIsArray($pivotSettings);
        $this->assertTrue($pivotSettings['notifications']);
        $this->assertFalse($pivotSettings['auto_save']);
        $this->assertEquals(30, $pivotSettings['timeout']);
    }

    /** @test */
    public function it_can_manage_notes(): void
    {
        // Arrange
        $notes = 'This is a test note for the pivot relationship';

        $pivot = new BaseMorphPivot();
        $pivot->notes = $notes;

        // Act
        $pivotNotes = $pivot->notes;

        // Assert
        $this->assertEquals($notes, $pivotNotes);
    }

    /** @test */
    public function it_can_manage_description(): void
    {
        // Arrange
        $description = 'Test description for pivot relationship';

        $pivot = new BaseMorphPivot();
        $pivot->description = $description;

        // Act
        $pivotDescription = $pivot->description;

        // Assert
        $this->assertEquals($description, $pivotDescription);
    }

    /** @test */
    public function it_can_manage_url(): void
    {
        // Arrange
        $url = 'https://example.com/pivot/123';

        $pivot = new BaseMorphPivot();
        $pivot->url = $url;

        // Act
        $pivotUrl = $pivot->url;

        // Assert
        $this->assertEquals($url, $pivotUrl);
    }

    /** @test */
    public function it_can_manage_image_url(): void
    {
        // Arrange
        $imageUrl = 'https://example.com/images/pivot.jpg';

        $pivot = new BaseMorphPivot();
        $pivot->image_url = $imageUrl;

        // Act
        $pivotImageUrl = $pivot->image_url;

        // Assert
        $this->assertEquals($imageUrl, $pivotImageUrl);
    }

    /** @test */
    public function it_can_manage_external_id(): void
    {
        // Arrange
        $externalId = 'ext_12345';

        $pivot = new BaseMorphPivot();
        $pivot->external_id = $externalId;

        // Act
        $pivotExternalId = $pivot->external_id;

        // Assert
        $this->assertEquals($externalId, $pivotExternalId);
    }

    /** @test */
    public function it_can_manage_source(): void
    {
        // Arrange
        $source = 'api_import';

        $pivot = new BaseMorphPivot();
        $pivot->source = $source;

        // Act
        $pivotSource = $pivot->source;

        // Assert
        $this->assertEquals($source, $pivotSource);
    }

    /** @test */
    public function it_can_manage_version(): void
    {
        // Arrange
        $version = '1.2.3';

        $pivot = new BaseMorphPivot();
        $pivot->version = $version;

        // Act
        $pivotVersion = $pivot->version;

        // Assert
        $this->assertEquals($version, $pivotVersion);
    }

    /** @test */
    public function it_can_manage_hash(): void
    {
        // Arrange
        $hash = 'abc123def456';

        $pivot = new BaseMorphPivot();
        $pivot->hash = $hash;

        // Act
        $pivotHash = $pivot->hash;

        // Assert
        $this->assertEquals($hash, $pivotHash);
    }

    /** @test */
    public function it_can_manage_checksum(): void
    {
        // Arrange
        $checksum = 'sha256:abc123def456';

        $pivot = new BaseMorphPivot();
        $pivot->checksum = $checksum;

        // Act
        $pivotChecksum = $pivot->checksum;

        // Assert
        $this->assertEquals($checksum, $pivotChecksum);
    }

    /** @test */
    public function it_can_manage_size(): void
    {
        // Arrange
        $size = 1024;

        $pivot = new BaseMorphPivot();
        $pivot->size = $size;

        // Act
        $pivotSize = $pivot->size;

        // Assert
        $this->assertEquals($size, $pivotSize);
    }

    /** @test */
    public function it_can_manage_mime_type(): void
    {
        // Arrange
        $mimeType = 'application/json';

        $pivot = new BaseMorphPivot();
        $pivot->mime_type = $mimeType;

        // Act
        $pivotMimeType = $pivot->mime_type;

        // Assert
        $this->assertEquals($mimeType, $pivotMimeType);
    }

    /** @test */
    public function it_can_manage_encoding(): void
    {
        // Arrange
        $encoding = 'UTF-8';

        $pivot = new BaseMorphPivot();
        $pivot->encoding = $encoding;

        // Act
        $pivotEncoding = $pivot->encoding;

        // Assert
        $this->assertEquals($encoding, $pivotEncoding);
    }

    /** @test */
    public function it_can_manage_language(): void
    {
        // Arrange
        $language = 'en';

        $pivot = new BaseMorphPivot();
        $pivot->language = $language;

        // Act
        $pivotLanguage = $pivot->language;

        // Assert
        $this->assertEquals($language, $pivotLanguage);
    }

    /** @test */
    public function it_can_manage_locale(): void
    {
        // Arrange
        $locale = 'en_US';

        $pivot = new BaseMorphPivot();
        $pivot->locale = $locale;

        // Act
        $pivotLocale = $pivot->locale;

        // Assert
        $this->assertEquals($locale, $pivotLocale);
    }

    /** @test */
    public function it_can_manage_timezone(): void
    {
        // Arrange
        $timezone = 'Europe/Rome';

        $pivot = new BaseMorphPivot();
        $pivot->timezone = $timezone;

        // Act
        $pivotTimezone = $pivot->timezone;

        // Assert
        $this->assertEquals($timezone, $pivotTimezone);
    }

    /** @test */
    public function it_can_manage_currency(): void
    {
        // Arrange
        $currency = 'EUR';

        $pivot = new BaseMorphPivot();
        $pivot->currency = $currency;

        // Act
        $pivotCurrency = $pivot->currency;

        // Assert
        $this->assertEquals($currency, $pivotCurrency);
    }

    /** @test */
    public function it_can_manage_decimal_places(): void
    {
        // Arrange
        $decimalPlaces = 2;

        $pivot = new BaseMorphPivot();
        $pivot->decimal_places = $decimalPlaces;

        // Act
        $pivotDecimalPlaces = $pivot->decimal_places;

        // Assert
        $this->assertEquals($decimalPlaces, $pivotDecimalPlaces);
    }

    /** @test */
    public function it_can_manage_rounding_mode(): void
    {
        // Arrange
        $roundingMode = 'half_up';

        $pivot = new BaseMorphPivot();
        $pivot->rounding_mode = $roundingMode;

        // Act
        $pivotRoundingMode = $pivot->rounding_mode;

        // Assert
        $this->assertEquals($roundingMode, $pivotRoundingMode);
    }
}
>>>>>>> laraxot/master
