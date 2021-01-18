<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOwnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('owners', function (Blueprint $table) {
            $table->id();
            $table->string('reputation');
            $table->integer('user_id');
            $table->string('user_type');
            $table->string('profile_image');
            $table->string('display_name');
            $table->string('link');
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
        Schema::dropIfExists('owners');
    }
}

/** 
-- public."owner" definition

-- Drop table

-- DROP TABLE public."owner";

CREATE TABLE public."owner" (
	id serial NOT NULL,
	reputation int4 NULL,
	user_id varchar NULL,
	user_type varchar NULL,
	profile_image varchar NULL,
	display_name varchar NULL,
	link varchar NULL,
	CONSTRAINT owner_new_pkey PRIMARY KEY (id)
);
*/
