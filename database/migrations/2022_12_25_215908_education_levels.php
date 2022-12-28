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
        Schema::create('education_levels', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
        });

        DB::table('education_levels')->insert([
            ['name' => 'Полное образование'],
            ['name' => 'Среднее специальное образование'],
            ['name' => 'Базовое высшее'],
            ['name' => 'Углубленное высшее'],
            ['name' => 'Асперантура'],
            ['name' => 'Дополнительное'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('education_levels');
    }
};
