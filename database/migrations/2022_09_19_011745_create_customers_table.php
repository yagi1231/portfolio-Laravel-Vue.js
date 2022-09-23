<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id()->unique()->comment('id');
            $table->foreignId('staff_id')->constrained('users')->onDelete('cascade')->comment('外部キー');
            $table->string('name')->comment('お客様名');
            $table->string('address')->comment('お客様アドレス');
            $table->string('tel')->comment('お客様電話番号');
            $table->string('remarks')->nullable()->comment('備考欄');
            $table->integer('update_user_id')->nullable()->comment('更新者');
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
        Schema::dropIfExists('customers');
    }
}
