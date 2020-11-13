<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImportTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('import_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('display_name');
            $table->timestamps();
        });

        \Illuminate\Support\Facades\DB::table('import_types')->insert([
            [
                'name' => 'sausage',
                'display_name' => 'Сосиска в тесте'
            ],
            [
                'name' => 'samsa',
                'display_name' => 'Самса'
            ],
            [
                'name' => 'cottage_pancake',
                'display_name' => 'Блинчик с творогом'
            ],
            [
                'name' => 'milk_pancake',
                'display_name' => 'Блинчик с сгущенкой'
            ],
            [
                'name' => 'sirniks',
                'display_name' => 'Сирники'
            ],
            [
                'name' => 'gum',
                'display_name' => 'Жевачка'
            ],[
                'name' => 'eclair',
                'display_name' => 'Эклер'
            ],[
                'name' => 'kurut',
                'display_name' => 'Курут'
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
        Schema::dropIfExists('import_types');
    }
}
