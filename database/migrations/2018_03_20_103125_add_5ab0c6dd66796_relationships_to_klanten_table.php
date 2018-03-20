<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ab0c6dd66796RelationshipsToKlantenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('klantens', function(Blueprint $table) {
            if (!Schema::hasColumn('klantens', 'naam_id')) {
                $table->integer('naam_id')->unsigned()->nullable();
                $table->foreign('naam_id', '132172_5aae9da652d16')->references('id')->on('bedrijfs')->onDelete('cascade');
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
        Schema::table('klantens', function(Blueprint $table) {
            
        });
    }
}
