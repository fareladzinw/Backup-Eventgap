<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembayaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userId');
            $table->unsignedBigInteger('eventId');
            $table->integer('total')->nullable();
            $table->string('buktiPembayaran')->nullable();
            $table->boolean('status');
            $table->timestamps();

            $table->foreign('userId')->references('id')->on('users');
            $table->foreign('eventId')->references('id')->on('daftar_events');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembayarans');
    }
}
