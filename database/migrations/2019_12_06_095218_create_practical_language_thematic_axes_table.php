<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
/**
 * Class CreatePracticalLanguageThematicAxesTable.
 */
class CreatePracticalLanguageThematicAxesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('practical_language_thematic_axes', function(Blueprint $table) {
            $table->increments('id');
            $table->text('practical_language_thematic_axis');
            $table->integer('bncc_curricular_component_id')->unsigned();

            $table->timestamps();
            $table->foreign('bncc_curricular_component_id')->references('id')->on('bncc_curricular_components')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('practical_language_thematic_axes');
	}
}
