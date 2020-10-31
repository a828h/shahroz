<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('desc')->nullable();
            $table->enum('platform', ['telegram', 'instagram_post', 'instagram_story']);
            $table->enum('status', ['demo', 'draft', 'active', 'archive']);
            $table->double('impersion_cnt', 12, 0)->default(0);
            $table->double('reach_cnt', 12, 0)->default(0);
            $table->double('clicks_cnt', 12, 0)->default(0);
            $table->double('like_cnt', 12, 0)->default(0);
            $table->double('share_cnt', 12, 0)->default(0);
            $table->double('save_cnt', 12, 0)->default(0);
            $table->double('sticker_tap_cnt', 12, 0)->default(0);
            $table->double('comment_cnt', 12, 0)->default(0);
            $table->enum('resource_type',['none', 'campaign', 'content', 'all'])->default('none');
            $table->timestamp('start_at')->nullable();
            $table->timestamp('end_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campaigns');
    }
}
