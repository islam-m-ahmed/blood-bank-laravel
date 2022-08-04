<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDonationRequestsTable extends Migration {

	public function up()
	{
		Schema::create('donation_requests', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('patient_name');
			$table->string('patient_phone') ;
			$table->smallInteger('patient_age') ;
			$table->integer('city_id')->unsigned();
			$table->smallInteger('bags_num') ;
			$table->integer('blood_type_id')->unsigned();
			$table->string('hospital_address') ;
			$table->text('notes')->nullable();
			$table->decimal('latitude', 10,8)->nullable();
			$table->decimal('longitude', 10,8)->nullable();
			$table->integer('client_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('donation_requests');
	}
}
