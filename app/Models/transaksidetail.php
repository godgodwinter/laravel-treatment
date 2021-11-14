<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class transaksidetail extends Model
{
        public $table = "transaksidetail";

        use SoftDeletes;
        use HasFactory;

        protected $fillable = [
            'produk_id',
            'transaksi_id',
            'ket',
        ];


        public function transaksi()
        {
            return $this->belongsTo('App\Models\transaksi');
        }

        public function produk()
        {
            return $this->belongsTo('App\Models\produk');
        }


}
