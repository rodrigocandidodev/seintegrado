<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateStudentCnsTable.
 */
class CreateStudentCnsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('student_cns', function(Blueprint $table) {
            $table->increments('id');
            $table->string('matricula_cn')->nullable();
            $table->date('date_cn')->nullable();
            $table->string('termo')->nullable();
            $table->string('livro')->nullable();
            $table->string('folha')->nullable();
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
		Schema::drop('student_cns');
	}
}
