<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->integer('company_kt')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('geo', 100)->nullable();
            $table->json('options')->nullable();
            $table->string('short_script', 255)->nullable();
            $table->text('short_url', 1000)->nullable();
            $table->string('short_script_2', 255)->nullable();
            $table->text('short_url_2', 1000)->nullable();
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
        Schema::dropIfExists('companies');
    }
}
