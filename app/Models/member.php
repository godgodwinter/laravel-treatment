<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class member extends Model
{
        public $table = "member";

        use SoftDeletes;
        use HasFactory;

        protected $fillable = [
            'nama',
            'jk',
            'telp',
            'tgllahir',
            'alamat',
            'users_id',
            'photo',
        ];


        public function users()
        {
            return $this->belongsTo('App\Models\User');
        }

        public function getPhotoAttribute($value){

            return url('storage/'.$value);
        }

}
