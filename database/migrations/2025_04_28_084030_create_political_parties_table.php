<?php

// database/migrations/[timestamp]_create_political_parties_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoliticalPartiesTable extends Migration
{
    public function up()
    {
        Schema::create('political_parties', function (Blueprint $table) {
            $table->id('party_id');
            $table->string('party_name', 100)->unique();
            $table->string('password_hash');
            $table->string('party_acronym', 20)->unique();
            $table->string('registration_number', 50)->unique();
            $table->string('certificate_url', 255)->nullable();
            $table->string('logo_url', 255)->nullable();
            $table->string('president_name', 100);
            $table->string('president_photo_url', 255)->nullable();
            $table->string('contact_phone', 20);
            $table->string('contact_email', 100);
            $table->text('headquarters_address');
            $table->string('facebook_url', 255)->nullable();
            $table->string('twitter_url', 255)->nullable();
            $table->integer('founded_year');
            $table->string('slogan', 255)->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('rejection_reason')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamp('last_login')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('political_parties');
    }
}