<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDaftarEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daftar_events', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('eventUserId')->nullable();
            $table->unsignedBigInteger('sponsorUserId')->nullable();
            $table->string('namaEvent');
            $table->unsignedBigInteger('kategoriId');
            $table->text('deskripsi');
            $table->string('lokasi');
            $table->dateTime('dateTimeFrom')->format('m-d-Y');
            $table->dateTime('dateTimeUntil')->nullable()->format('m-d-Y');
            $table->string('waktu')->nullable();
            $table->boolean('statusSponsor')->default(0);
            $table->string('gambar')->nullable();
            $table->string('proposal')->nullable();
            $table->boolean('isFree')->default(1);
            $table->string('penyelenggara');
            $table->string('cp');
            $table->boolean('statusDraf')->default(0);
            $table->timestamps();

            $table->foreign('eventUserId')->references('id')->on('users');
            $table->foreign('SponsorUserId')->references('id')->on('users');
            $table->foreign('kategoriId')->references('id')->on('kategoris');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('daftar_events');
    }
}
