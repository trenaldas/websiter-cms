<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained();
            $table->foreignId('shipping_method_id')
                  ->nullable()
                  ->constrained();
            $table->unsignedTinyInteger('confirmed')->default(0);
            $table->string('confirm_code');
            $table->string('name');
            $table->string('last_name');
            $table->string('street_name');
            $table->string('city');
            $table->string('country');
            $table->string('phone');
            $table->string('email');
            $table->text('details');
            $table->string('status')->default('pending');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
}
