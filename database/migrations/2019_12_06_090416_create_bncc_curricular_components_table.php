<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateBnccCurricularComponentsTable.
 */
class CreateBnccCurricularComponentsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bncc_curricular_components', function(Blueprint $table) {
            $table->increments('id');
            $table->string('bncc_curricular_component');

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
		Schema::drop('bncc_curricular_components');
	}
}
