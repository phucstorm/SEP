<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePollAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poll__answers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('poll__question_id');
            $table->string('poll_answer_content', 160);
            $table->integer('votes');
            $table->timestamps();

            $table->index('poll__question_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('poll__answers');
    }
}
