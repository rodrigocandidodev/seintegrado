<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateSchoolYearsTable.
 */
class CreateSchoolYearsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('school_years', function(Blueprint $table) {
            $table->increments('id');
            $table->string('year',4);
            $table->date('first_day')->nullable();
            $table->date('last_day')->nullable();
            $table->string('school_year_status')->default('active');
            $table->integer('institution_id')->unsigned();

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
		Schema::drop('school_years');
	}
}
