<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('active')->default(1);
            $table->string('name');
            $table->string('surname');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->foreignId('selected_project_id')
                  ->nullable()
                  ->constrained('projects', 'id');
            $table->unsignedInteger('bits_count')->default(0);
            $table->unsignedInteger('photos_count')->default(0);
            $table->unsignedInteger('tags_count')->default(0);
            $table->unsignedInteger('projects_count')->default(0);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
}
