<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateExamTable.
 */
class CreateExamsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('exams', function(Blueprint $table) {
            $table->increments('id');
            $table->string('exam');
            $table->date('exam_date');
            $table->string('value');

            $table->integer('teacher_id')->unsigned();
            //$table->integer('division_id')->unsigned();
            $table->integer('school_year_id')->unsigned();
            $table->integer('curricular_component_id')->unsigned();
            $table->integer('institution_id')->unsigned();
            $table->integer('institution_class_id')->unsigned();

            $table->timestamps();

            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade');
            //$table->foreign('division_id')->references('id')->on('divisions')->onDelete('cascade');
            $table->foreign('school_year_id')->references('id')->on('school_years')->onDelete('cascade');
            $table->foreign('curricular_component_id')->references('id')->on('curricular_components')->onDelete('cascade');
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
		Schema::drop('exams');
	}
}
