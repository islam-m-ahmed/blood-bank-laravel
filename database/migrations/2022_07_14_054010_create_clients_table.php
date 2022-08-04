<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientsTable extends Migration {

	public function up()
	{
		Schema::create('clients', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name');
			$table->string('email');
			$table->string('phone');
			$table->string('password');
			$table->date('date_of_b');
			$table->integer('blood_type_id')->unsigned();
			$table->date('last_donation_date')->nullable();
			$table->integer('city_id')->unsigned();
			$table->smallInteger('pin_code')->nullable();
            $table->string('api_token', 60)->unique()->nullable();
            $table->enum('status',[0,1])->default(1);

        });
	}

	public function down()
	{
		Schema::drop('clients');
	}
}
