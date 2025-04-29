<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('party_posts', function (Blueprint $table) {
            $table->id('post_id'); // primary key
            $table->unsignedBigInteger('party_id'); // link to political party
            $table->string('title');
            $table->text('content');
            $table->enum('post_type', ['campaign', 'news', 'event', 'policy'])->default('news');
            $table->string('image_url')->nullable();
            $table->string('video_url')->nullable();
            $table->timestamps();

            $table->foreign('party_id')->references('id')->on('political_parties')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('party_posts');
    }
};
