<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('campaign_id');
            $table->enum('media_type', ['none', 'content', 'rows'])->default('none');
            $table->enum('resource_type', ['none', 'content', 'rows'])->default('none');
            $table->double('impersion_cnt', 12, 0)->default(0);
            $table->double('reach_cnt', 12, 0)->default(0);
            $table->double('clicks_cnt', 12, 0)->default(0);
            $table->double('like_cnt', 12, 0)->default(0);
            $table->double('share_cnt', 12, 0)->default(0);
            $table->double('save_cnt', 12, 0)->default(0);
            $table->double('sticker_tap_cnt', 12, 0)->default(0);
            $table->double('comment_cnt', 12, 0)->default(0);
            $table->enum('type', ['impression', 'fix', 'click', 'action', 'user'])->default('impression');
            $table->double('our_cost', 12, 0)->default(0);
            $table->double('dealer_cost', 12, 0)->default(0);
            $table->double('customer_cost', 12, 0)->default(0);
            $table->timestamps();

            $table->foreign('campaign_id')->references('id')->on('campaigns')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contents');
    }
}
