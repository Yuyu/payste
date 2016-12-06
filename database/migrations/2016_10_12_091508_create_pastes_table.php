<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePastesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("pastes", function(Blueprint $table) {
            $table->increments("id");
            $table->string("token")->unique();

            $table->boolean("encrypted")->default(false);
            $table->text("content");
            $table->string("syntax");
            $table->dateTime("created_at");

            $table->integer("user_id")->unsigned();


            $table->foreign("user_id")->references("id")->on("users")
                ->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop("pastes");
    }
}
