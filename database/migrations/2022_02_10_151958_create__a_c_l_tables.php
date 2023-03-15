<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateACLTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');//it is unsigned
            $table->string('name', 190)->unique(); //sysadmin, translator, etc.
            $table->string('label', 190)->nullable(true);
            $table->timestamps();
        });

        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('id');//it is unsigned
            $table->string('name', 190)->unique(); //read, edit-products, translate etc.
            $table->string('label', 190)->nullable(true);
            $table->timestamps();
        });

        //pivot table
        Schema::create('permission_role', function (Blueprint $table) {
            $table->integer('permission_id')->unsigned();
            $table->integer('role_id')->unsigned();
            $table->timestamps();


            //!important - to set foreign index fields types must match
            $table->foreign('permission_id')
                ->references('id')
                ->on('permissions')
                ->onDelete('cascade');

            //!important - to set foreign index fields types must match
            $table->foreign('role_id')
                ->references('id')
                ->on('roles')
                ->onDelete('cascade');

            //composite unique index
            $table->primary(['permission_id','role_id']);
        });

        Schema::create('role_user', function (Blueprint $table) {
            $table->integer('role_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();

            //!important - to set foreign index fields types must match
            $table->foreign('role_id')
                ->references('id')
                ->on('roles')
                ->onDelete('cascade');

            //!important - to set foreign index fields types must match
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            //composite unique index
            $table->primary(['role_id','user_id']);
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_user');
        Schema::dropIfExists('permission_role');
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('roles');
    }
}
