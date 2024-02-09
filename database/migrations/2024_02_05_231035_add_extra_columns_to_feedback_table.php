<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExtraColumnsToFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('feedback', function (Blueprint $table) {
            $table->foreignId('point_a_id')->nullable()->constrained('cities');
            $table->foreignId('point_b_id')->nullable()->constrained('cities');
            $table->smallInteger('delivery_type');
            $table->double('weight')->nullable();
            $table->double('volume')->nullable();
            $table->double('mileage')->nullable();
            $table->double('seats_number')->nullable();
            $table->integer('order_date')->nullable();
            $table->foreignId('activity_id')->nullable()->constrained('activities');
            $table->foreignId('additional_id')->nullable()->constrained('additional_functions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('feedback', function (Blueprint $table) {
            $table->dropForeign(['point_a_id']);
            $table->dropForeign(['point_b_id']);
            $table->dropForeign(['additional_id']);
            $table->dropForeign(['activity_id']);

            $table->dropColumn('point_a_id');
            $table->dropColumn('point_b_id');
            $table->dropColumn('delivery_type');
            $table->dropColumn('weight');
            $table->dropColumn('volume');
            $table->dropColumn('mileage');
            $table->dropColumn('seats_number');
            $table->dropColumn('order_date');
            $table->dropColumn('activity_id');
            $table->dropColumn('additional_id');
        });
    }
}
