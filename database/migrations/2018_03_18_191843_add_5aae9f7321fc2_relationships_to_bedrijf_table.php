<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5aae9f7321fc2RelationshipsToBedrijfTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bedrijfs', function(Blueprint $table) {
            if (!Schema::hasColumn('bedrijfs', 'achternaam_id')) {
                $table->integer('achternaam_id')->unsigned()->nullable();
                $table->foreign('achternaam_id', '132171_5aae9f70ac2a4')->references('id')->on('bedrijfs')->onDelete('cascade');
                }
                
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bedrijfs', function(Blueprint $table) {
            
        });
    }
}
