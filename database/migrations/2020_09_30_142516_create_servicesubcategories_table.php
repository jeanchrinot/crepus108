<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesubcategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicesubcategories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('servicecategory_id')->unsigned()->nullable();
            $table->foreign('servicecategory_id')->references('id')->on('servicecategories')->onDelete('cascade');
            $table->string('name');
            $table->string('slug');
            $table->text('details')->nullable();
            $table->string('image')->nullable();
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('servicesubcategories');
    }
}
