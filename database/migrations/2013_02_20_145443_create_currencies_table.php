<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateCurrenciesTable extends Migration
{
    public function up(): void
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

        DB::table('currencies')->insert([
            ['name' => 'USD'],
            ['name' => 'GBP'],
            ['name' => 'EUR'],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('currencies');
    }
}
