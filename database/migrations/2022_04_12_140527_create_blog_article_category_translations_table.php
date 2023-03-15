<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogArticleCategoryTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_article_category_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('blog_article_category_id');
            $table->string('locale')->index();
            $table->string('title');
            $table->string('slug');
            $table->text('description')->nullable();
            $table->boolean('is_enabled')->default(false); // 0 - disabled, 1- enabled
            $table->timestamps();

            $table->foreign('blog_article_category_id', 'category_id')
                ->references('id')
                ->on('blog_article_categories')
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
        Schema::dropIfExists('blog_article_category_translations');
    }
}
