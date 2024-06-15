<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateCollaboratorContactsTable.
 */
class CreateCollaboratorContactsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('collaborator_contacts', function(Blueprint $table) {
            $table->increments('id');
            $table->string('phone1')->nullable();
            $table->string('phone2')->nullable();
            $table->integer('collaborator_id')->unsigned();

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
		Schema::drop('collaborator_contacts');
	}
}
