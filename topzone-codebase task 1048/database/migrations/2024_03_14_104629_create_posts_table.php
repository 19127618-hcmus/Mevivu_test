<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            // $table->string('slug')->unique();
            // $table->boolean('is_featured')->default(false);
            // $table->enum('status', ['draft', 'published'])->default('draft');
            // $table->string('image')->nullable();
            $table->text('excerpt');
            $table->text('content');
            // $table->dateTime('posted_at');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
