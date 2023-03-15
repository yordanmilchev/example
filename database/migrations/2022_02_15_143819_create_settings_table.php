<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('setting_type');
            $table->text('setting_value')->nullable();
            $table->string('data_type')->nullable();
            $table->string('description')->nullable();
            $table->string('group')->nullable(); // groups settings in one pannel
            $table->string('is_system')->default(true); // is the setting used for system purposes (not editable by users)
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
