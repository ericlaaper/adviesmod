<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ab0cfb5205aaRelationshipsToBedrijfTable extends Migration
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
                $table->foreign('achternaam_id', '132171_5aae9f70ac2a4')->references('id')->on('relatiemanagers')->onDelete('cascade');
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
            if(Schema::hasColumn('bedrijfs', 'achternaam_id')) {
                $table->dropForeign('132171_5aae9f70ac2a4');
                $table->dropIndex('132171_5aae9f70ac2a4');
                $table->dropColumn('achternaam_id');
            }
            
        });
    }
}
