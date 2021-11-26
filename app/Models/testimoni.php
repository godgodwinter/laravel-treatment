<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class testimoni extends Model
{
        public $table = "testimoni";

        use SoftDeletes;
        use HasFactory;

        protected $fillable = [
            'member_id',
            'pesan',
            'tgl',
            'status',
            'photo',
        ];

        public function member()
        {
            return $this->belongsTo('App\Models\member');
        }
        public function getPhotoAttribute($value){

            return url('storage/'.$value);
        }

}
