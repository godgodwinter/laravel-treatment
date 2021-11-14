<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class dokter extends Model
{
        public $table = "dokter";

        use SoftDeletes;
        use HasFactory;

        protected $fillable = [
            'nama',
            'jk',
            'spesialisasi',
            'telp',
            'tgllahir',
            'alamat',
            'ket',
            'photo',
        ];

    public function getPhotoAttribute($value){

        return url('storage/'.$value);
    }

}
