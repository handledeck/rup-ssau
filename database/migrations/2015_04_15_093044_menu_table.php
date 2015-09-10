<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MenuTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('menu', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('name');
            $table->string('url')->nullable();
            $table->boolean('active')->default(false);
            $table->string('class')->nullable();
            $table->string('icon')->nullable();
            $table->integer('parent')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('menu');
	}

}
