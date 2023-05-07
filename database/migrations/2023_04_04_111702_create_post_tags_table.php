<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('post_tags', function (Blueprint $table) {
            $table->unsignedBigInteger('post_id');
            $table->unsignedBigInteger('tag_id');

            $table->index(['post_id', 'tag_id']);
            $table->index(['tag_id', 'post_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('post_tags');
    }
};
