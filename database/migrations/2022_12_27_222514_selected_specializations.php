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
        Schema::create('selected_specializations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_data_id');
            $table->foreignId('specialization_id');

            $table->foreign('post_data_id')->references('id')->on('posts');
            $table->foreign('specialization_id')->references('id')->on('specializations');
        });

        DB::table('selected_specializations')->insert([
            [
                'post_data_id' => 1,
                'specialization_id' => 1,
            ],
            [
                'post_data_id' => 1,
                'specialization_id' => 2,
            ],
            [
                'post_data_id' => 1,
                'specialization_id' => 3,
            ],
            [
                'post_data_id' => 2,
                'specialization_id' => 2,
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
