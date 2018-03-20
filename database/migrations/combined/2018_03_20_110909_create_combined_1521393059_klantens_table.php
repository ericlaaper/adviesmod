<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombined1521393059KlantensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('klantens')) {
            Schema::create('klantens', function (Blueprint $table) {
                $table->increments('id');
                $table->string('voornaam')->nullable();
                $table->string('achternaam')->nullable();
                $table->string('email')->nullable();
                $table->string('password')->nullable();
                $table->string('geslacht')->nullable();
                
                $table->timestamps();
                $table->softDeletes();

                $table->index(['deleted_at']);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('klantens');
    }
}
