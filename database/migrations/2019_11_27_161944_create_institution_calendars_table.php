<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateInstitutionCalendarsTable.
 */
class CreateInstitutionCalendarsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('institution_calendars', function(Blueprint $table) {
            $table->increments('id');
            $table->date('day');
            $table->integer('activity_id')->unsigned();
            $table->string('motive');
            $table->string('class_day');
            $table->string('year',4);
            $table->integer('institution_id')->unsigned();

            $table->timestamps();

            $table->foreign('activity_id')->references('id')->on('institution_calendar_activities')->onDelete('cascade');
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
		Schema::drop('institution_calendars');
	}
}
