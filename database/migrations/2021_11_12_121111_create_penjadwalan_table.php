<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenjadwalanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penjadwalan', function (Blueprint $table) {
            $table->bigIncrements('id');
            // $table->string('jadwaltreatment_id');
            $table->string('perawatan_id');
            $table->string('status')->nullable();
            $table->string('tgl')->nullable();
            $table->string('dokter_id')->nullable();
            $table->string('ruangan')->nullable();
            $table->string('jam')->nullable();
            $table->string('pengingat')->nullable();
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
        Schema::dropIfExists('penjadwalan');
    }
}
