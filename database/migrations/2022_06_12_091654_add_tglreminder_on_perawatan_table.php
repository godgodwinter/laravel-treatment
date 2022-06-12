<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTglreminderOnPerawatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('perawatan', function (Blueprint $table) {
            // $table->text('tglperawatan')->nullable(); //tgl_perawatan skrg
            $table->text('tglreminder')->nullable(); //tgl_perawatan berikutnya
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
