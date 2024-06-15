<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateCollaboratorAdressesTable.
 */
class CreateCollaboratorAddressesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('collaborator_addresses', function(Blueprint $table) {
            $table->increments('id');
            $table->string('street')->nullable();
            $table->string('block')->nullable();
            $table->string('land_lot')->nullable();
            $table->string('number')->nullable();
            $table->string('neighborhood')->nullable();
            $table->string('zipcode',14)->nullable();
            $table->string('complement')->nullable();
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
		Schema::drop('collaborator_addresses');
	}
}
