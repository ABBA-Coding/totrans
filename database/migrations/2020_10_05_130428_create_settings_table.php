<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->jsonb('meta_title')->nullable();
            $table->jsonb('meta_description')->nullable();
            $table->jsonb('meta_keywords')->nullable();
            $table->text('meta_tags')->nullable();
            $table->jsonb('slogan')->nullable();
            $table->jsonb('address')->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('phone2', 20)->nullable();
            $table->string('email', 40)->nullable();
            $table->string('email2', 40)->nullable();
            $table->string('fax', 40)->nullable();
            $table->string('instagram', 500)->nullable();
            $table->string('twitter', 500)->nullable();
            $table->string('vk', 500)->nullable();
            $table->string('facebook', 500)->nullable();
            $table->string('telegram', 500)->nullable();
            $table->string('linkedin', 500)->nullable();
            $table->string('youtube', 500)->nullable();
            $table->string('map_iframe', 500)->nullable();
            $table->string('map_link', 500)->nullable();
            $table->integer('logo_id')->nullable();
            $table->integer('favicon_id')->nullable();
            $table->smallInteger('coming_soon')->default(0);
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
        Schema::dropIfExists('settings');
    }
}
