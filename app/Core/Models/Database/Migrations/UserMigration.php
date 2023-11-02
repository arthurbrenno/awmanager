<?php

namespace App\Core\Models\Database\Migrations;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

class UserMigration
{
    public static function up(): void
    {
        if (Capsule::schema()->hasTable('users'))
        {
            return;
        }

        Capsule::schema()->create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps();
        });

    }

    public static function down(): void
    {
        if (Capsule::schema()->hasTable('tasks'))
        {
            Capsule::table('tasks')->where('user_id', '!=', null)->delete();
        }
        Capsule::schema()->disableForeignKeyConstraints();
        Capsule::schema()->dropIfExists('users');
        Capsule::schema()->enableForeignKeyConstraints();
    }

}
