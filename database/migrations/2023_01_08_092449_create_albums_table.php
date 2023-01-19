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
        Schema::create('albums', function (Blueprint $table) {
            $table->id()->comment('アルバムID');
            $table->string('name')->comment('アルバム名');
            $table->timestamps();
            $table->tinyInteger('is_private')->default(0)->comment('外部非公開アルバムフラグ');
            $table->unsignedBigInteger('user_id')->comment('作成者ID');
            $table->string('icon')->nullable()->comment('アルバムアイコン');
            $table->string('extension')->nullable()->comment('アイコン拡張子');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
        });

        DB::statement("ALTER TABLE albums COMMENT 'アルバムテーブル'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('albums');
    }
};
