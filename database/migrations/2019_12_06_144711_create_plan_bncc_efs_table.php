<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
/**
 * Class CreatePlanBnccEfsTable.
 */
class CreatePlanBnccEfsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('plan_bncc_efs', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title_theme');
            $table->integer('daily_plan_id')->unsigned();
            $table->integer('curricular_component_id')->unsigned();
            $table->text('prior_knowledge');
            $table->text('materials_required');
            $table->text('practical_application');
            $table->text('evaluation');

            $table->timestamps();
            $table->foreign('daily_plan_id')->references('id')->on('daily_plans')->onDelete('cascade');
            $table->foreign('curricular_component_id')->references('id')->on('curricular_components')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('plan_bncc_efs');
	}
}
