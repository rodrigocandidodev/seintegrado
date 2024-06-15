<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateStudentContactsTable.
 */
class CreateStudentContactsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('student_contacts', function(Blueprint $table) {
            $table->increments('id');
            $table->string('phone1')->nullable();
            $table->string('phone1_responsable')->nullable();
            $table->string('phone2')->nullable();
            $table->string('phone2_responsable')->nullable();
            $table->string('phone3')->nullable();
            $table->string('phone3_responsable')->nullable();
            $table->string('enrollment_year');
            $table->integer('student_id')->unsigned();

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
		Schema::drop('student_contacts');
	}
}
