<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("pastes", function(Blueprint $table) {
            $table->dropForeign(["user_id"]);
            $table->dropColumn("user_id");
        });
        Schema::drop("users");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create("users", function(Blueprint $table) {
            $table->increments("id");
            $table->string("email");
            $table->string("password");
        });
        Schema::table('pastes', function(Blueprint $table) {
            $table->integer("user_id")->unsigned();
            $table->foreign("user_id")->references("id")->on("users")
                ->onDelete("cascade");
        });
    }
}
