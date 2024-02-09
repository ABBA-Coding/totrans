<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string('application_number', 10)->unique();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('point_a_id')->constrained('cities');
            $table->foreignId('point_b_id')->constrained('cities');
            $table->smallInteger('delivery_type');
            $table->smallInteger('type')->default(1);
            $table->double('weight')->nullable();
            $table->double('volume')->nullable();
            $table->double('mileage')->nullable();
            $table->double('seats_number')->nullable();
            $table->integer('order_date')->nullable();
            $table->integer('arrival_date')->nullable();
            $table->foreignId('additional_id')->nullable()->constrained('additional_functions');
            $table->smallInteger('status')->default(1);
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
        Schema::dropIfExists('applications');
    }
}
