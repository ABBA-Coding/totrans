<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistrictsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('districts', function (Blueprint $table) {
            $table->id();
            $table->string('name_uz');
            $table->string('name_ru');
            $table->string('name_en');
            $table->timestamps();
        });

        \Illuminate\Support\Facades\DB::table('districts')->insert($this->getData());
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('districts');
    }

    protected function getData(): array
    {
        return [
            0 => [
                'name_ru' => 'Андижанская область',
                'name_uz' => 'Andijon viloyati',
                'name_en' => 'Andijan Region',
            ],
            1 => [
                'name_ru' => 'Бухарская область',
                'name_uz' => 'Buxoro viloyati',
                'name_en' => 'Bukhara Region',
            ],
            2 => [
                'name_ru' => 'Ферганская область',
                'name_uz' => "Farg'ona viloyati",
                'name_en' => 'Fergana Region',
            ],
            3 => [
                'name_ru' => 'Джизакская область',
                'name_uz' => 'Jizzax viloyati',
                'name_en' => 'Jizzakh Region',
            ],
            4 => [
                'name_ru' => 'Каракалпакстан (автономная республика)',
                'name_uz' => "Qoraqalpog'iston (avtonom respublika)",
                'name_en' => 'Karakalpakstan (autonomous republic)',
            ],
            5 => [
                'name_ru' => 'Наманганская область',
                'name_uz' => 'Namangan viloyati',
                'name_en' => 'Namangan Region',
            ],
            6 => [
                'name_ru' => 'Навоийская область',
                'name_uz' => 'Navoiy viloyati',
                'name_en' => 'Navoiy Region',
            ],
            7 => [
                'name_ru' => 'Кашкадарьинская область',
                'name_uz' => 'Qashqadaryo viloyati',
                'name_en' => 'Qashqadaryo Region',
            ],
            8 => [
                'name_ru' => 'Самаркандская область',
                'name_uz' => 'Samarqand viloyati',
                'name_en' => 'Samarqand Region',
            ],
            9 => [
                'name_ru' => 'Сырдарьинская область',
                'name_uz' => 'Sirdaryo viloyati',
                'name_en' => 'Sirdaryo Region',
            ],
            10 => [
                'name_ru' => 'Сурхандарьинская область',
                'name_uz' => 'Surxondaryo viloyati',
                'name_en' => 'Surxondaryo Region',
            ],
            11 => [
                'name_ru' => 'Ташкент',
                'name_uz' => 'Tashkent',
                'name_en' => 'Tashkent',
            ],
            12 => [
                'name_ru' => 'Ташкентская область',
                'name_uz' => 'Toshkent viloyati',
                'name_en' => 'Tashkent Region',
            ],
            13 => [
                'name_ru' => 'Хорезмская область',
                'name_uz' => 'Xorazm viloyati',
                'name_en' => 'Xorazm Region',
            ],
        ];
    }
}
