<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create1521536944Mod1sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('mod1s')) {
            Schema::create('mod1s', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('mod1vr1')->nullable();
                $table->string('mod1opm1')->nullable();
                $table->integer('mod1vr2')->nullable();
                $table->string('mod1opm2')->nullable();
                
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
        Schema::dropIfExists('mod1s');
    }
}
