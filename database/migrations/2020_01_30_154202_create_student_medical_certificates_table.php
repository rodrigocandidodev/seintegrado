<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
/**
 * Class CreateStudentMedicalCertificatesTable.
 */
class CreateStudentMedicalCertificatesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('student_medical_certificates', function(Blueprint $table) {
            $table->increments('id');

            $table->integer('student_id')->unsigned();
            $table->date('from_date');
            $table->date('to_date');
            $table->string('amount_days');
            $table->string('cid');
            $table->integer('institution_id')->unsigned();

            $table->foreign('institution_id')->references('id')->on('institutions')->onDelete('cascade');
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
		Schema::drop('student_medical_certificates');
	}
}
