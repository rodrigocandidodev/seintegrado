<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateInstitutionClassSchedulesTable.
 */
class CreateInstitutionClassSchedulesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('institution_class_schedules', function(Blueprint $table) {
            $table->increments('id');

            $table->time('hour');

            $table->string('week_day');
            $table->string('sequence');

            $table->integer('institution_class_id')->unsigned();
            $table->integer('curricular_component_id')->unsigned();
            $table->integer('institution_id')->unsigned();
            $table->integer('school_year_id')->unsigned();

            $table->foreign('institution_class_id')->references('id')->on('institution_classes')->onDelete('cascade');
            $table->foreign('curricular_component_id')->references('id')->on('curricular_components')->onDelete('cascade');
            $table->foreign('institution_id')->references('id')->on('institutions')->onDelete('cascade');
            $table->foreign('school_year_id')->references('id')->on('school_years')->onDelete('cascade');

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
		Schema::drop('institution_class_schedules');
	}
}
