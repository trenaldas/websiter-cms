<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBitsTable extends Migration
{
    public function up(): void
    {
        Schema::create('bits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->nullable()->constrained('bits');
            $table->foreignId('tag_id')->constrained();
            $table->foreignId('bit_theme_id')->constrained();
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->longText('text')->nullable();
            $table->unsignedInteger('price')->nullable();
            $table->unsignedInteger('old_price')->nullable();
            $table->string('code')->nullable();
            $table->unsignedTinyInteger('active')->default(1);
            $table->unsignedTinyInteger('popular')->default(0);
            $table->unsignedInteger('position')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bits');
    }
}
