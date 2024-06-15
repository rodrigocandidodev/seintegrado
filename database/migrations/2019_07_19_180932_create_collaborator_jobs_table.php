<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateCollaboratorJobsTable.
 */
class CreateCollaboratorJobsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('collaborator_jobs', function(Blueprint $table) {
            $table->increments('id');
            $table->string('job_year',4);
            $table->string('job_status');
            $table->integer('job_id')->unsigned();
            $table->integer('collaborator_id')->unsigned();

            $table->foreign('job_id')->references('id')->on('jobs')->onDelete('cascade');
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
		Schema::drop('collaborator_jobs');
	}
}
