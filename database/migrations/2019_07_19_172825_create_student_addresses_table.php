<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateStudentAdressesTable.
 */
class CreateStudentAddressesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('student_addresses', function(Blueprint $table) {
            $table->increments('id');
            $table->string('street')->nullable();
            $table->string('block')->nullable();
            $table->string('land_lot')->nullable();
            $table->string('number')->nullable();
            $table->string('neighborhood')->nullable();
            $table->string('zipcode',14)->nullable();
            $table->string('complement')->nullable();
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
		Schema::drop('student_addresses');
	}
}
