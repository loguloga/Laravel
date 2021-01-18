<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('link');
            $table->string('question_id');
            $table->string('creation_date');
            $table->integer('view_count');
            $table->integer('answer_count');
            $table->integer('score');
            $table->string('last_activity_date');
            $table->boolean('is_answered')->default(0);
            $table->string('accepted_answer_id');
            $table->integer('tag_id');
            $table->integer('owner_id');
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
        Schema::dropIfExists('questions');
    }
}

/**
 -- public.question definition
 
 -- Drop table
 
 -- DROP TABLE public.question;
 
 CREATE TABLE public.question (
     id serial NOT NULL,
     title varchar NULL,
     link varchar NULL,
     question_id varchar NULL,
     creation_date varchar NULL,
     is_answered bool NULL DEFAULT false,
     view_count int4 NULL,
     answer_count int4 NULL,
     score int4 NULL,
     last_activity_date varchar NULL,
     accepted_answer_id varchar NULL,
     tag_id int4 NULL,
     owner_id int4 NULL,
     CONSTRAINT question_new_pkey PRIMARY KEY (id)
 );
 */