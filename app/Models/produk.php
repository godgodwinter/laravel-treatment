<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class produk extends Model
{
        public $table = "produk";

        use SoftDeletes;
        use HasFactory;

        protected $fillable = [
            'nama',
            'harga',
            'label',
            'photo',
        ];

        // public function kategori()
        // {
        //     return $this->belongsTo('App\Models\kategori');
        // }
        // public function users()
        // {
        //     return $this->belongsTo('App\Models\User');
        // }

}