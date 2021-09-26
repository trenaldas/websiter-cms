<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateBitThemesTable extends Migration
{
    public function up(): void
    {
        Schema::create('bit_themes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('blade');
            $table->softDeletes();
            $table->timestamps();
        });

        DB::table('bit_themes')->insert([
            [
                "name"  => "Text and Photo",
                'blade' => 'text-and-photo',
            ],
            [
                "name"  => "Photo and Text",
                'blade' => 'photo-and-text',
            ],
            [
                "name"  => "Text Only",
                'blade' => 'text-only',
            ],
            [
                "name"  => "Full Size Photo",
                'blade' => 'full-size-photo',
            ],
            [
                "name"  => "Two Photos",
                'blade' => 'two-photos',
            ],
            [
                "name"  => "Three Photos",
                'blade' => 'three-photos',
            ],
            [
                "name"  => "Four Photos",
                'blade' => 'four-photos',
            ],
            [
                "name"  => "Six Photos",
                'blade' => 'six-photos',
            ],
            [
                "name"  => "Twelve Photos",
                'blade' => 'twelve-photos',
            ]
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('bit_themes');
    }
}
