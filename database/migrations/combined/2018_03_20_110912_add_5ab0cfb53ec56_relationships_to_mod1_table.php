<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ab0cfb53ec56RelationshipsToMod1Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mod1s', function(Blueprint $table) {
            if (!Schema::hasColumn('mod1s', 'achternaam_id')) {
                $table->integer('achternaam_id')->unsigned()->nullable();
                $table->foreign('achternaam_id', '132996_5ab0cfb273b65')->references('id')->on('klantens')->onDelete('cascade');
                }
                if (!Schema::hasColumn('mod1s', 'created_by_id')) {
                $table->integer('created_by_id')->unsigned()->nullable();
                $table->foreign('created_by_id', '132996_5ab0cfb27e86c')->references('id')->on('users')->onDelete('cascade');
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
        Schema::table('mod1s', function(Blueprint $table) {
            if(Schema::hasColumn('mod1s', 'achternaam_id')) {
                $table->dropForeign('132996_5ab0cfb273b65');
                $table->dropIndex('132996_5ab0cfb273b65');
                $table->dropColumn('achternaam_id');
            }
            if(Schema::hasColumn('mod1s', 'created_by_id')) {
                $table->dropForeign('132996_5ab0cfb27e86c');
                $table->dropIndex('132996_5ab0cfb27e86c');
                $table->dropColumn('created_by_id');
            }
            
        });
    }
}
