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
            $table->string('cfa_url',200); 
            $table->string('vetstreet_url',200);
            $table->string('vcahospitals_url',200);
            $table->string('temperament',200);
            $table->string('origin',50); 
            $table->char('country_codes',2);
            $table->char('country_code',2); 
            $table->text('description'); 
            $table->string('life_span',12); 
            $table->tinyInteger('indoor');
            $table->tinyInteger('lap');
            $table->string('alt_names',50); 
            $table->tinyInteger('adaptability'); 
            $table->tinyInteger('affection_level'); 
            $table->tinyInteger('child_friendly'); 
            $table->tinyInteger('dog_friendly'); 
            $table->tinyInteger('energy_level'); 
            $table->tinyInteger('grooming');  
            $table->tinyInteger('health_issues'); 
            $table->tinyInteger('intelligence'); 
            $table->tinyInteger('shedding_level'); 
            $table->tinyInteger('social_needs'); 
            $table->tinyInteger('stranger_friendly'); 
            $table->tinyInteger('vocalisation'); 
            $table->tinyInteger('experimental'); 
            $table->tinyInteger('hairless');
            $table->tinyInteger('naturalr'); 
            $table->tinyInteger('rare'); 
            $table->tinyInteger('rex'); 
            $table->tinyInteger('suppressed_tail'); 
            $table->tinyInteger('short_legs'); 
            $table->string('wikipedia_url',200);
            $table->tinyInteger('hypoallergenic');
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
