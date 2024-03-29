<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUrlChecksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('url_checks', function (Blueprint $table) {
            $table->id();
            // Поле которое будет внешним ключом
            $table->bigInteger('url_id');
            // Добавление внешнего ключа (ограничения)
            $table->foreign('url_id')->references('id')->on('urls');
            $table->integer('status_code')->nullable();
            $table->string('h1')->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('url_checks');
    }
}
