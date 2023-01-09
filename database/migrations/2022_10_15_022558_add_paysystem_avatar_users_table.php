<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaysystemAvatarUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function(Blueprint $table) {
            $table->string('paysystem', 255)->nullable($value = true);
            $table->string('payid', 255)->nullable($value = true);
            $table->string('avatar', 255)->nullable($value = true);
            $table->unsignedSmallInteger('role')->nullable();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['paysystem', 'payid', 'avatar', 'role']);
            $table->dropSoftDeletes();
        });
     
    }
}
