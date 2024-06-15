<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateAdminTypeChoicesTable.
 */
class CreateAdminTypeChoicesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('admin_type_choices', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('admin_id')->unsigned();
            $table->integer('admin_type_id')->unsigned();

			$table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
			$table->foreign('admin_type_id')->references('id')->on('admin_types')->onDelete('cascade');

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
		Schema::drop('admin_type_choices');
	}
}
