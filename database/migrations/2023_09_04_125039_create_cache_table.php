<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use Modules\Xot\Database\Migrations\XotBaseMigration;

/*
 * Undocumented class.
 */
<<<<<<< HEAD
return new class extends XotBaseMigration
{
=======
return new class extends XotBaseMigration {
>>>>>>> laraxot/master
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // -- CREATE --
        $this->tableCreate(static function (Blueprint $table): void {
            $table->string('key')->primary();
            $table->mediumText('value');
            $table->integer('expiration');
        });
    }
};
