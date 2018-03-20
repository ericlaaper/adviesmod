<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create1521391951RelatiemanagersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('relatiemanagers')) {
            Schema::create('relatiemanagers', function (Blueprint $table) {
                $table->increments('id');
                $table->string('voornaam')->nullable();
                $table->string('achternaam')->nullable();
                $table->string('email');
                
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
        Schema::dropIfExists('relatiemanagers');
    }
}
