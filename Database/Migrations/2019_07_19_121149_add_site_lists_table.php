<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSiteListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('site_lists', function (Blueprint $table) {
          $table->increments('id');
          $table->string('identifier');
          $table->string('name');
          $table->string('type');
          $table->text('value')->nullable(); // FIXME : JSON
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('site_lists');

    }
}
