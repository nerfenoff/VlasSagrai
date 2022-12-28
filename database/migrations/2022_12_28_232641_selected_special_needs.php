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
        Schema::create('selected_special_needs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_data_id');
            $table->foreignId('special_needs_id');

            $table->foreign('post_data_id')->references('id')->on('posts');
            $table->foreign('special_needs_id')->references('id')->on('special_needs');
        });

        DB::table('selected_special_needs')->insert([
            ['post_data_id' => 1, 'special_needs_id' => 1],
            ['post_data_id' => 1, 'special_needs_id' => 2],
            ['post_data_id' => 1, 'special_needs_id' => 3],
            
            ['post_data_id' => 2, 'special_needs_id' => 2],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('selected_special_needs');
    }
};
