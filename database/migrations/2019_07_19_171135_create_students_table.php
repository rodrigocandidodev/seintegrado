<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateStudentsTable.
 */
class CreateStudentsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('students', function(Blueprint $table) {
                  $table->increments('id');
                  $table->string('name');
                  $table->string('mother');
                  $table->string('father')->nullable();
                  $table->string('legal_responsable');
                  $table->string('email',80)->unique();
                  $table->timestamp('email_verified_at')->nullable();
                  $table->string('password');
                  $table->string('cpf',11)->nullable();
                  $table->date('date_birth');
                  $table->string('place_birth');
                  $table->string('sus_number')->nullable();
                  $table->string('auth_image_use',5);
                  $table->string('health_special_needs')->nullable();
                  $table->string('health_problem')->nullable();

                  $table->integer('institution_id')->unsigned();
                  $table->integer('gender_id')->unsigned();
                  $table->integer('color_id')->unsigned();

                  $table->foreign('institution_id')->references('id')->on('institutions')->onDelete('cascade');
                  $table->foreign('gender_id')->references('id')->on('genders')->onDelete('cascade');
                  $table->foreign('color_id')->references('id')->on('colors')->onDelete('cascade');

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
		Schema::drop('students');
	}
}
