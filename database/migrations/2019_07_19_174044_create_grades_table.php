<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateGradesTable.
 */
class CreateGradesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('grades', function(Blueprint $table) {
            $table->increments('id');
            $table->string('grade');
            $table->string('beginnig_age');

            $table->integer('scholarity_id')->unsigned();

            $table->foreign('scholarity_id')->references('id')->on('scholarities')->onDelete('cascade');

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
		Schema::drop('grades');
	}
}
