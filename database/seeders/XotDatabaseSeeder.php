<?php

declare(strict_types=1);

namespace Modules\Xot\Database\Seeders;

<<<<<<< HEAD
use Illuminate\Database\Seeder;

/**
 * Orchestratore Xot — N modelli owner = N {Model}Seeder (regola Laraxot).
 */
class XotDatabaseSeeder extends Seeder
{
    public function run(): void
    {
        if ($this->command !== null) {
            $this->command->info('XotDatabaseSeeder: entity seeders…');
        }

        $this->call([
            CacheSeeder::class,
            CacheLockSeeder::class,
            ExtraSeeder::class,
            FeedSeeder::class,
            HealthCheckResultHistoryItemSeeder::class,
            InformationSchemaTableSeeder::class,
            LogSeeder::class,
            ModuleSeeder::class,
            PulseAggregateSeeder::class,
            PulseEntrySeeder::class,
            PulseValueSeeder::class,
            SessionSeeder::class,
        ]);

        if ($this->command !== null) {
            $this->command->info('XotDatabaseSeeder: completato.');
        }
=======
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

/**
 * Class XotDatabaseSeeder.
 */
class XotDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Model::unguard();

        // $this->call("OthersTableSeeder");
>>>>>>> laraxot/master
    }
}
