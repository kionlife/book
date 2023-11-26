<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('genre_id');
            $table->unsignedBigInteger('author_id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('isbn')->nullable();
            $table->string('language')->nullable();
            $table->string('publisher')->nullable();
            $table->string('year')->nullable();
            $table->string('pages')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('genre_id')->references('id')->on('genres')->onDelete('cascade');
            $table->foreign('author_id')->references('id')->on('authors')->onDelete('cascade');
        });

        Schema::create('book_instances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('book_id');
            $table->unsignedBigInteger('user_owner_id');
            $table->unsignedBigInteger('current_user_id')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();

            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
            $table->foreign('user_owner_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('current_user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('book_exchange_log', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('book_instance_id');
            $table->unsignedBigInteger('user_from_id');
            $table->unsignedBigInteger('user_to_id');
            $table->timestamps();

            $table->foreign('book_instance_id')->references('id')->on('book_instances')->onDelete('cascade');
            $table->foreign('user_from_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('user_to_id')->references('id')->on('users')->onDelete('cascade');

        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_instances');
        Schema::dropIfExists('book_exchange_log');
        Schema::dropIfExists('books');
    }
};
