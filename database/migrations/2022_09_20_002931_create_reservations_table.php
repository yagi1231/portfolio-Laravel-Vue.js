<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->increments('id')->unique()->comment('id');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->comment('外部キー');
            $table->string('name')->comment('お客様名');
            $table->string('address')->comment('お客様アドレス');
            $table->string('tel')->comment('お客様電話番号');
            $table->string('order')->comment('注文内容');
            $table->integer('price')->nullable()->comment('金額');
            $table->integer('sumprice')->comment('合計金額');
            $table->string('delivery')->nullable()->comment('配達員名');
            $table->string('time')->comment('予定配達時間');
            $table->string('end_time')->nullable()->comment('配達完了時間');
            $table->string('status')->default('準備中')->comment('配達状況');
            $table->string('remarks')->nullable()->comment('備考欄');
            $table->unsignedTinyInteger('role_id')->nullable()->comment('管理者権限');
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->dateTime('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
