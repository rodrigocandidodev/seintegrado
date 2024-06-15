<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateInstitutionClassesTable.
 */
class CreateInstitutionClassesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('institution_classes', function(Blueprint $table) {
            $table->increments('id');
            $table->string('institution_class');
            $table->string('school_shift')->nullable();
            $table->integer('grade_id')->unsigned();
            $table->integer('institution_id')->unsigned();
            $table->integer('school_year_id')->unsigned();
            $table->string('max_amount_student')->default('25');

            $table->foreign('grade_id')->references('id')->on('grades')->onDelete('cascade');
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
		Schema::drop('classes');
	}
}
