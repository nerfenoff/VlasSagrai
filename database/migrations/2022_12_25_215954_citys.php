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
        Schema::create('citys', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
        });

        DB::table('citys')->insert([
            ['name' => 'Минск'],
            ['name' => 'Гомель'],
            ['name' => 'Витебск'],
            ['name' => 'Могилёв'],
            ['name' => 'Гродно'],
            ['name' => 'Брест'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('citys');
    }
};
