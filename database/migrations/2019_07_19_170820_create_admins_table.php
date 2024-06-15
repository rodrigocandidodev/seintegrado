<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateAdminsTable.
 */
class CreateAdminsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('admins', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email',80)->unique();
            $table->timestamp('email_verified_at')->nullable();
			$table->string('password');
			$table->string('admin_status')->default('active');
			$table->integer('collaborator_id')->unsigned();
			$table->integer('institution_id')->unsigned();

			$table->foreign('collaborator_id')->references('id')->on('collaborators')->onDelete('cascade');
			$table->foreign('institution_id')->references('id')->on('institutions')->onDelete('cascade');
            $table->rememberToken();
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
		Schema::drop('admins');
	}
}
