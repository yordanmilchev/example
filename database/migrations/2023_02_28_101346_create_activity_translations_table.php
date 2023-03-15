<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivityTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('activity_id');
            $table->string('locale')->index();
            $table->string('title');
            $table->string('slug');
            $table->text('excerpt')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_enabled')->default(false); // 0 - disabled, 1- enabled
            $table->timestamps();

            $table->foreign('activity_id')
                ->references('id')
                ->on('activities')
                ->onDelete('cascade');
            $table->unique(['locale', 'slug']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activity_translations');
    }
}
