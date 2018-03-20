<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1521534683KlantensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('klantens', function (Blueprint $table) {
            
if (!Schema::hasColumn('klantens', 'geslacht')) {
                $table->string('geslacht')->nullable();
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
        Schema::table('klantens', function (Blueprint $table) {
            $table->dropColumn('geslacht');
            
        });

    }
}
