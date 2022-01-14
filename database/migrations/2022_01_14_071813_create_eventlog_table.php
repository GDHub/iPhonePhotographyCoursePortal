<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventlogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventlog', function (Blueprint $table) {
            $table->id('eventlog_id');
            $table->increments('eventlog_id');
            $table->enum('eventtype', ['LESSONWATCHED', 'COMMENTWRITTEN']);
            $table->foreignId('user_id')->constrained();
            $table->string('comment', 200);
            $table->timestamp('eventdate');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eventlog');
    }
}
