<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPembayaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_pembayarans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pembayaranId');
            $table->unsignedBigInteger('tiketId');
            $table->integer('qty');
            $table->integer('harga');
            $table->boolean('status');
            $table->timestamps();

            $table->foreign('pembayaranId')->references('id')->on('pembayarans');
            $table->foreign('tiketId')->references('id')->on('tikets');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_pembayarans');
    }
}
