<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImgBreedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('img_breeds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('url', 200);
            $table->string('breed',12);
            $table->tinyInteger('off')->default('1'); 
            $table->unsignedBigInteger('breed_id');
            $table->foreign('breed_id')->references('id')->on('breeds')->onDelete('cascade');
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
        Schema::dropIfExists('img_breeds');
    }
}
