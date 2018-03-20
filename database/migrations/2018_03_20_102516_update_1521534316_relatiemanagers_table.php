<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1521534316RelatiemanagersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('relatiemanagers', function (Blueprint $table) {
            
if (!Schema::hasColumn('relatiemanagers', 'geslacht')) {
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
        Schema::table('relatiemanagers', function (Blueprint $table) {
            $table->dropColumn('geslacht');
            
        });

    }
}
