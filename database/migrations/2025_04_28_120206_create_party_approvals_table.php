<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartyApprovalsTable extends Migration
{
    public function up()
    {
        Schema::create('party_approvals', function (Blueprint $table) {
            $table->id();
            $table->string('party_name')->unique();
            $table->string('party_acronym')->unique();
            $table->string('registration_number')->unique();
            $table->string('certificate_url')->nullable();
            $table->string('logo_url')->nullable();
            $table->string('president_name');
            $table->string('president_photo_url')->nullable();
            $table->string('contact_phone');
            $table->string('contact_email');
            $table->text('headquarters_address');
            $table->string('facebook_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->integer('founded_year');
            $table->string('slogan')->nullable();
            $table->string('password_hash');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('party_approvals');
    }
}
