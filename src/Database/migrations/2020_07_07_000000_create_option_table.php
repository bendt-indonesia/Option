<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('option', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 150);
            $table->string('slug', 150);
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_reserved')->default(false);
            $table->boolean('is_modifiable')->default(true);

            $table->timestamps();
            $table->unsignedInteger('created_by_id')->nullable();
            $table->unsignedInteger('updated_by_id')->nullable();
            $table->unsignedInteger('deleted_by_id')->nullable();
            $table->softDeletes();

            $table->foreign('created_by_id')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('updated_by_id')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('deleted_by_id')->references('id')->on('users')->onDelete('restrict');
        });

        Schema::create('option_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('option_id');

            $table->string('name', 150);
            $table->string('value', 150)->nullable();
            $table->string('code', 150)->nullable();

            $table->boolean('is_reserved')->default(false);
            $table->boolean('is_modifiable')->default(false);

            $table->timestamps();
            $table->unsignedInteger('created_by_id')->nullable();
            $table->unsignedInteger('updated_by_id')->nullable();
            $table->unsignedInteger('deleted_by_id')->nullable();
            $table->softDeletes();

            $table->foreign('option_id')->references('id')->on('option')->onDelete('restrict');
            $table->foreign('created_by_id')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('updated_by_id')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('deleted_by_id')->references('id')->on('users')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('option_detail');
        Schema::dropIfExists('option');
    }
}
