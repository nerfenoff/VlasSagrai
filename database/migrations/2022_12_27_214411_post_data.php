<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts_data', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->string('phone')->nullable();

            $table->foreignId('education_level');
            $table->foreignId('city');
            $table->foreignId('educational_institution');
            $table->boolean('the_presence_of_a_barrier_free_environment');
            $table->foreignId('form_of_education');
            $table->string('address', 500)->nullable();
            $table->string('coords', 300)->nullable();

            $table->foreignId('post_data_id'); //->default(2);


            $table->foreign('education_level')->references('id')->on('education_levels');
            $table->foreign('city')->references('id')->on('citys');
            $table->foreign('educational_institution')->references('id')->on('educational_institutions');
            $table->foreign('form_of_education')->references('id')->on('form_of_educations');

            $table->foreign('post_data_id')->references('id')->on('posts');
        });
        
        DB::table('posts_data')->insert([
            [
                'image' => null,
                'phone' => null,
                'education_level' => 1,
                'city' => 1,
                'educational_institution' => 3,
                'the_presence_of_a_barrier_free_environment' => true,
                'form_of_education' => 1,
                'address' => 'проспект Независимости, 65',
                'post_data_id' => 1,
                'coords' => '53.920897, 27.593155'
            ],
            [
                'image' => null,
                'phone' => null,
                'education_level' => 2,
                'city' => 3,
                'educational_institution' => 1,
                'the_presence_of_a_barrier_free_environment' => false,
                'form_of_education' => 2,
                'address' => 'проспект Независимости, 6',
                'post_data_id' => 2,
                'coords' => '53.894612, 27.548096'
            ],
        ]);

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts_data');
    }
};
