<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateCurricularComponentsTable.
 */
class CreateCurricularComponentsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('curricular_components', function(Blueprint $table) {
            $table->increments('id');
            $table->string('component');
            $table->string('year');
            $table->string('abbreviation',4);
            $table->integer('institution_id')->unsigned();
            $table->integer('knowledge_area_id')->unsigned();

			$table->foreign('institution_id')->references('id')->on('institutions')->onDelete('cascade');
			$table->foreign('knowledge_area_id')->references('id')->on('knowledge_areas')->onDelete('cascade');

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
		Schema::drop('curricular_components');
	}
}
