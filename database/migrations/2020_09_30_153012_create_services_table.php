<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('servicesubcategory_id')->unsigned()->nullable();
            $table->foreign('servicesubcategory_id')->references('id')->on('servicesubcategories')->onDelete('cascade');
            $table->string('name',100);
            $table->string('slug');
            $table->text('details')->nullable();
            $table->string('price')->nullable();
            $table->integer('duration')->nullable();
            $table->string('image')->nullable();
            $table->boolean('availability')->default(true);
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
        Schema::dropIfExists('services');
    }
}
