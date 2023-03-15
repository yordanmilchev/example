<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGalleryImageCategoryTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gallery_image_category_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('gallery_image_category_id');
            $table->string('locale')->index();
            $table->string('title');
            $table->string('slug');
            $table->boolean('is_enabled')->default(false); // 0 - disabled, 1- enabled
            $table->timestamps();

            $table->foreign('gallery_image_category_id', 'image_category_id')
                ->references('id')
                ->on('gallery_image_categories')
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
        Schema::dropIfExists('gallery_image_category_translations');
    }
}
