<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('domain_url')->unique()->nullable();
            $table->string('subdomain_url')->unique()->nullable();
            $table->string('demo_url')->nullable();
            $table->foreignId('currency_id')->default(1)->constrained();
            $table->string('title');
            $table->unsignedTinyInteger('active')->default(0);
            $table->text('description');
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('twitter')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('send_email_on_order');
            $table->string('seller_details_for_order');
            $table->string('vat_percent');
            $table->string('cart_finish_success_title');
            $table->string('cart_finish_success');
            $table->string('google_analytics');
            $table->string('query_title');
            $table->string('query_message');
            $table->string('mail_query_success_title');
            $table->string('mail_query_success_message');
            $table->string('footer_copyright');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
}
