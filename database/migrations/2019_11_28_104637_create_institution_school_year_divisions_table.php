<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateInstitutionSchoolYearDivisionsTable.
 */
class CreateInstitutionSchoolYearDivisionsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('institution_school_year_divisions', function(Blueprint $table) {
            $table->increments('id');
            $table->string('division');
            $table->integer('institution_id')->unsigned();

            $table->timestamps();

            $table->foreign('institution_id')->references('id')->on('institutions')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('institution_school_year_divisions');
	}
}
