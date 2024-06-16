<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
/**
 * Class CreateApplicationFieldThematicUnitsTable.
 */
class CreateApplicationFieldThematicUnitsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('application_field_thematic_units', function(Blueprint $table) {
            $table->increments('id');
            $table->text('application_field_thematic_unit');
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
		Schema::drop('application_field_thematic_units');
	}
}
