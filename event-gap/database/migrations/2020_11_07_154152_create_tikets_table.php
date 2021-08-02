<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTiketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tikets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('eventId');
            $table->string('namaTiket');
            $table->string('deskripsi')->nullable();
            $table->integer('harga');
            $table->integer('qty');
            $table->dateTime('dateTimeFrom')->format('m-d-Y');
            $table->dateTime('dateTimeUntil')->nullable()->format('m-d-Y');
            $table->string('gambar')->nullable();

            $table->timestamps();

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
        Schema::dropIfExists('tikets');
    }
}
