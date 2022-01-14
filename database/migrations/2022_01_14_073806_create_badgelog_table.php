<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBadgelogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('badgelog', function (Blueprint $table) {
            $table->id();
            $table->increments('id');
            $table->foreignId('user_id')->constrained();
            $table->string('badge', 200);
            $table->string('comment', 200)->nullable();
            $table->integer('watched');
            $table->integer('written');
            $table->timestamp('badge_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('badgelog');
    }
}
