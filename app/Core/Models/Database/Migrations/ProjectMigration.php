<?php

namespace App\Core\Models\Database\Migrations;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

class ProjectMigration
{
    public static function up(): void
    {
        if (Capsule::schema()->hasTable('projects'))
        {
            return;
        }

        Capsule::schema()->create('projects', function(Blueprint $table) {
            $table->increments('id');
            $table->string('titulo');
            $table->string('description');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });

    }

    public static function down(): void
    {
        Capsule::schema()->disableForeignKeyConstraints();
        Capsule::schema()->dropIfExists('projects');
        Capsule::schema()->enableForeignKeyConstraints();
    }

}