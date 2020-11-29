<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableCampaigns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('campaigns', function (Blueprint $table) {
            $table->unsignedBigInteger('hunter_id')->default(1);
            $table->foreign('hunter_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('executor_id')->default(1);
            $table->foreign('executor_id')->references('id')->on('users')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('campaigns', function (Blueprint $table) {
            $table->dropForeign(["hunter_id","executor_id"]);
            $table->dropColumn(["hunter_id","executor_id"]);
        });
    }
}
