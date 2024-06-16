<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
/**
 * Class CreateDailyPlansTable.
 */
class CreateDailyPlansTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('daily_plans', function(Blueprint $table) {
            $table->increments('id');
            $table->date('plan_date');
            $table->integer('class_plan');
            $table->integer('teacher_id');
            $table->date('delivery_date');
            $table->date('plan_created_at');
            $table->integer('group_id');
            $table->integer('institution_id');
            $table->integer('school_year_division_id');
            $table->integer('school_year_id');
            $table->integer('scholarity_id');

            $table->timestamps();

            $table->foreign('class_plan')->references('id')->on('institution_classes')->onDelete('cascade');
            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade');
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
            $table->foreign('institution_id')->references('id')->on('institutions')->onDelete('cascade');
            $table->foreign('school_year_division_id')->references('id')->on('institution_school_year_divisions')->onDelete('cascade');
            $table->foreign('school_year_id')->references('id')->on('school_years')->onDelete('cascade');
            $table->foreign('scholarity_id')->references('id')->on('scholarities')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('daily_plans');
	}
}
