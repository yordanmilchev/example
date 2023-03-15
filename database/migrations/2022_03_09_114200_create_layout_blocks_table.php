<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLayoutBlocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('layout_blocks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('region_name')->nullable()->comment('LayoutRegionConstant class values');
            $table->text('static_content')->nullable();
            $table->string('dynamic_content')->nullable()->comment('DynamicLayoutBlockConstant class values. Override static_content value.');
            $table->smallInteger('weight')->default(0)->comment('Block with weight 1 is shown before 5');
            $table->boolean('is_enabled')->default(false);
            $table->string('locale',5)->nullable();
            $table->string('url_filter_operator',20)->nullable();
            $table->text('url_filter_values')->nullable();
            $table->timestamps();

            $table->index('region_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('layout_blocks');
    }
}
