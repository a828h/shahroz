<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentRowTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_row', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('content_id');
            $table->double('impersion_cnt', 12, 0)->default(0);
            $table->double('reach_cnt', 12, 0)->default(0);
            $table->double('clicks_cnt', 12, 0)->default(0);
            $table->double('like_cnt', 12, 0)->default(0);
            $table->double('share_cnt', 12, 0)->default(0);
            $table->double('save_cnt', 12, 0)->default(0);
            $table->double('sticker_tap_cnt', 12, 0)->default(0);
            $table->double('comment_cnt', 12, 0)->default(0);
            $table->timestamps();

            $table->foreign('content_id')->references('id')->on('contents')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('content_row');
    }
}
