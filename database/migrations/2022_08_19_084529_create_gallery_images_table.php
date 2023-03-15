<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGalleryImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gallery_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('gallery_image_category_id')->nullable();
            $table->string('name');
            $table->string('title')->nullable();
            $table->integer('position')->nullable()->default(1);
            $table->timestamps();

            $table->foreign('gallery_image_category_id')
                ->references('id')
                ->on('gallery_image_categories')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gallery_images');
    }
}
