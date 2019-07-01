<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('event_name');
            $table->string('event_code');
            $table->string('event_link');
            $table->string('event_description');
            $table->string('user_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->boolean('setting_join');
            $table->boolean('setting_question');
            $table->boolean('setting_reply');
            $table->boolean('setting_moderation');
            $table->boolean('setting_anonymous');
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
        Schema::dropIfExists('events');
    }
}