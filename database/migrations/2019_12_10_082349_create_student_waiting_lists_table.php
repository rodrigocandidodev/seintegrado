<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
/**
 * Class CreateStudentWaitingListsTable.
 */
class CreateStudentWaitingListsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('student_waiting_lists', function(Blueprint $table) {
            $table->increments('id');
            $table->string('candidate_waiting_list');
            $table->string('responsable');
            $table->string('phone');
            $table->integer('institution_id')->unsigned();
            $table->string('enrollment_year',4);
            $table->integer('institution_class_id')->unsigned();

            $table->timestamps();
            $table->foreign('institution_id')->references('id')->on('institutions')->onDelete('cascade');
            $table->foreign('institution_class_id')->references('id')->on('institution_classes')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('student_waiting_lists');
	}
}
