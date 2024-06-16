<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
/**
 * Class CreateInstitutionClassStudentSequencesTable.
 */
class CreateInstitutionClassStudentSequencesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('institution_class_student_sequences', function(Blueprint $table) {
            $table->increments('id');

            $table->string('sequence_number');

            $table->integer('institution_id')->unsigned();
            $table->integer('student_id')->unsigned();
            $table->integer('institution_class_id')->unsigned();
            $table->integer('school_year_id')->unsigned();


            $table->foreign('institution_id')->references('id')->on('institutions')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('institution_class_id')->references('id')->on('institution_classes')->onDelete('cascade');
            $table->foreign('school_year_id_id')->references('id')->on('school_years')->onDelete('cascade');

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
		Schema::drop('institution_class_student_sequences');
	}
}
