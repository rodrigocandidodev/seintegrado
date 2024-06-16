<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
/**
 * Class CreateStudentSchoolAttendancesTable.
 */
class CreateStudentSchoolAttendancesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('student_school_attendances', function(Blueprint $table) {
            $table->increments('id');

            $table->date('day');

            $table->integer('student_id')->unsigned();
            $table->integer('institution_class_schedule_id')->unsigned();
            $table->integer('institution_id')->unsigned();

            $table->foreign('institution_id')->references('id')->on('institutions')->onDelete('cascade');
            $table->foreign('institution_class_schedule_id')->references('id')->on('institution_class_schedules')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');

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
		Schema::drop('student_school_attendances');
	}
}
