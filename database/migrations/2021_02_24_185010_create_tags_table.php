<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagsTable extends Migration
{
    public function up(): void
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->nullable()->constrained('tags');
            $table->foreignId('project_id')->constrained();
            $table->string('name');
            $table->string('description')->nullable();
            $table->unsignedTinyInteger('active');
            $table->unsignedTinyInteger('home')->default(0);
            $table->unsignedInteger('position')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tags');
    }
}
