<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionPlansTable extends Migration
{
    public function up(): void
    {
        Schema::create('subscription_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedInteger('monthly_cost');
            $table->string('monthly_cost_stripe_id');
            $table->unsignedInteger('yearly_cost');
            $table->string('yearly_cost_stripe_id');
            $table->unsignedInteger('three_years');
            $table->string('three_years_stripe_id');
            $table->unsignedInteger('projects');
            $table->unsignedInteger('photos');
            $table->unsignedInteger('bits');
            $table->unsignedInteger('tags');
            $table->timestamps();
        });

        DB::table('subscription_plans')->insert([
            [
                'name'                   => 'Mini Web',
                'monthly_cost'           => 0,
                'monthly_cost_stripe_id' => '',
                'yearly_cost'            => 0,
                'yearly_cost_stripe_id'  => '',
                'three_years'            => 0,
                'three_years_stripe_id'  => '',
                'projects'               => 3,
                'photos'                 => 100,
                'bits'                   => 100,
                'tags'                   => 100,
            ],
            [
                'name'                   => 'Midi Web',
                'monthly_cost'           => 700,
                'monthly_cost_stripe_id' => 'stripe_plan_id',
                'yearly_cost'            => 500,
                'yearly_cost_stripe_id'  => 'stripe_plan_id',
                'three_years'            => 300,
                'three_years_stripe_id'  => 'stripe_plan_id',
                'projects'               => 9,
                'photos'                 => 500,
                'bits'                   => 500,
                'tags'                   => 500,
            ],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('subscription_plans');
    }
}
