<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateStudentEnrollmentsTable.
 */
class CreateStudentEnrollmentsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('student_enrollments', function(Blueprint $table) {
            $table->increments('id');
            $table->string('enrollment_code')->unique();
            $table->string('enrollment_number')->nullable();
            $table->date('enrollment_date');
            $table->date('transfer_date')->nullable();
            $table->string('transfer_type',5)->nullable();
            $table->string('enrollment_year',4);
            $table->string('degree_relatedness')->nullable();
            $table->string('name')->nullable();
            $table->string('cpf')->nullable();
            $table->string('rg')->nullable();
            $table->string('rg_emissor')->nullable();
            $table->integer('institution_class_id')->unsigned();
            $table->integer('enrollment_status_id')->unsigned();
            $table->integer('student_id')->unsigned();
            $table->integer('collaborator_id')->unsigned();
            $table->integer('institution_id')->unsigned();

            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('institution_class_id')->references('id')->on('institution_classes')->onDelete('cascade');
            $table->foreign('enrollment_status_id')->references('id')->on('enrollment_statuses')->onDelete('cascade');
            $table->foreign('collaborator_id')->references('id')->on('collaborators')->onDelete('cascade');
            $table->foreign('institution_id')->references('id')->on('institutions')->onDelete('cascade');

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
		Schema::drop('student_enrollments');
	}
}
