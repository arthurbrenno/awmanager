<?php

namespace App\Core\Models\Database\Migrations;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

class AvatarMigration
{
    public static function up(): void
    {
        if (Capsule::schema()->hasTable('avatars'))
        {
            return;
        }

        Capsule::schema()->create('avatars', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')
                                              ->on('users')
                                              ->onDelete('cascade');
        });
    }

    public static function down(): void
    {
        Capsule::schema()->disableForeignKeyConstraints();
        Capsule::schema()->dropIfExists('avatars');
        Capsule::schema()->enableForeignKeyConstraints();
    }

}