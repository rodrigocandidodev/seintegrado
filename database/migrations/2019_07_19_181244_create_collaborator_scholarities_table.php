<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateCollaboratorScholaritiesTable.
 */
class CreateCollaboratorScholaritiesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('collaborator_scholarities', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('scholarity_id')->unsigned();
            $table->integer('collaborator_id')->unsigned();

            $table->foreign('scholarity_id')->references('id')->on('scholarities')->onDelete('cascade');
            $table->foreign('collaborator_id')->references('id')->on('collaborators')->onDelete('cascade');

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
		Schema::drop('collaborator_scholarities');
	}
}
