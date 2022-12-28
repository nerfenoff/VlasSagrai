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
        Schema::create('form_of_educations', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
        });

        DB::table('form_of_educations')->insert([
            ['name' => 'Дневная'],
            ['name' => 'Заочная'],
            ['name' => 'Вечерняя'],
            ['name' => 'Дистанционная'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('form_of_educations');
    }
};
