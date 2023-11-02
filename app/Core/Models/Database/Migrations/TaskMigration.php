<?php

namespace App\Core\Models\Database\Migrations;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

class TaskMigration
{
    public static function up(): void
    {
        if (Capsule::schema()->hasTable('tasks'))
        {
            return;
        }

        Capsule::schema()->create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('description');
            $table->string('status');
            $table->string('priority');
            $table->timestamps();
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
        Capsule::schema()->dropIfExists('tasks');
        Capsule::schema()->enableForeignKeyConstraints();
    }
}
