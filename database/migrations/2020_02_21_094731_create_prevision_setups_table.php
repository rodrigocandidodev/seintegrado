<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreatePrevisionSetupsTable.
 */
class CreatePrevisionSetupsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('prevision_setups', function(Blueprint $table) {
            $table->increments('id');

            $table->string('total_hours');
            $table->string('year');
            $table->integer('curricular_component_id')->unsigned();
            $table->integer('institution_id')->unsigned();
            $table->integer('grade_id')->unsigned();


            $table->foreign('institution_id')->references('id')->on('institutions')->onDelete('cascade');
            $table->foreign('curricular_component_id')->references('id')->on('curricular_components')->onDelete('cascade');
            $table->foreign('grade_id')->references('id')->on('grades')->onDelete('cascade');

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
		Schema::drop('prevision_setups');
	}
}
