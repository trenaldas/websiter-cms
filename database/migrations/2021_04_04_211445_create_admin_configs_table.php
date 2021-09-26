<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateAdminConfigsTable extends Migration
{
    public function up(): void
    {
        Schema::create('admin_configs', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->timestamps();
        });

        DB::table('admin_configs')
            ->insert(['email' => 'hi@tnyweb.com']);
    }

    public function down(): void
    {
        Schema::dropIfExists('admin_configs');
    }
}
