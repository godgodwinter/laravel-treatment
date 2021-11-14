<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class transaksi extends Model
{
        public $table = "transaksi";

        use SoftDeletes;
        use HasFactory;

        protected $fillable = [
            'uuid',
            'member_id',
            'tgl',
            'status',
            'totaltagihan',
        ];

        public function member()
        {
            return $this->belongsTo('App\Models\member');
        }


        public function transaksidetail()
        {
            return $this->hasMany('App\Models\transaksidetail');
        }


}
