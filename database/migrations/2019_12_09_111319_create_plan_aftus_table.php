<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
/**
 * Class CreatePlanAftusTable.
 */
class CreatePlanAftusTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('plan_aftus', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('application_field_thematic_unit_id')->unsigned();
            $table->integer('plan_bncc_ef_id')->unsigned();

            $table->timestamps();
            $table->foreign('application_field_thematic_unit_id')->references('id')->on('application_field_thematic_units')->onDelete('cascade');
            $table->foreign('plan_bncc_ef_id')->references('id')->on('plan_bncc_efs')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('plan_aftus');
	}
}
