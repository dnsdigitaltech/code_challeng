<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBreedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('breeds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('id_breed',50); 
            $table->string('name',100);
            $table->string('weight_imperial',12); 
            $table->string('weight_metric',12); 
            $table->string('cfa_url',200)->nullable(); 
            $table->string('vetstreet_url',200)->nullable();
            $table->string('vcahospitals_url',200)->nullable();
            $table->string('temperament',200);
            $table->string('origin',50); 
            $table->char('country_codes',2);
            $table->char('country_code',2); 
            $table->text('description'); 
            $table->string('life_span',12); 
            $table->tinyInteger('indoor')->default('0');
            $table->tinyInteger('lap')->default('0');
            $table->string('alt_names',90); 
            $table->tinyInteger('adaptability')->default('0'); 
            $table->tinyInteger('affection_level')->default('0'); 
            $table->tinyInteger('child_friendly')->default('0'); 
            $table->tinyInteger('dog_friendly')->default('0'); 
            $table->tinyInteger('energy_level')->default('0'); 
            $table->tinyInteger('grooming')->default('0');  
            $table->tinyInteger('health_issues')->default('0'); 
            $table->tinyInteger('intelligence')->default('0'); 
            $table->tinyInteger('shedding_level')->default('0');
            $table->tinyInteger('social_needs')->default('0'); 
            $table->tinyInteger('stranger_friendly')->default('0'); 
            $table->tinyInteger('vocalisation')->default('0'); 
            $table->tinyInteger('experimental')->default('0'); 
            $table->tinyInteger('hairless')->default('0');
            $table->tinyInteger('naturalr')->default('0');
            $table->tinyInteger('rare')->default('0');
            $table->tinyInteger('rex')->default('0'); 
            $table->tinyInteger('suppressed_tail')->default('0'); 
            $table->tinyInteger('short_legs')->default('0'); 
            $table->string('wikipedia_url',200);
            $table->tinyInteger('hypoallergenic')->default('0');
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
        Schema::dropIfExists('breeds');
    }
}
