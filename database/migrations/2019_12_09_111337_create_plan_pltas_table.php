<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
/**
 * Class CreatePlanPltasTable.
 */
class CreatePlanPltasTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('plan_pltas', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('practical_language_thematic_axis_id')->unsigned();
            $table->integer('plan_bncc_ef_id')->unsigned();

            $table->timestamps();
            $table->foreign('practical_language_thematic_axis_id')->references('id')->on('practical_language_thematic_axes')->onDelete('cascade');
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
		Schema::drop('plan_pltas');
	}
}
