<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photos', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('画像名');
            $table->text('description')->comment('画像説明');
            $table->unsignedBigInteger('album_id')->comment('アルバムID');
            $table->timestamps();
            $table->tinyInteger('is_private')->default(0)->comment('外部非公開画像フラグ');
            $table->unsignedBigInteger('user_id')->comment('投稿者ID');
            $table->string('photo_img')->comment('投稿画像');
            $table->string('extension', 4)->comment('拡張子');

            $table->foreign('album_id')
                ->references('id')
                ->on('albums')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
        });

        DB::statement("ALTER TABLE photos COMMENT '画像テーブル'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('photos');
    }
};
