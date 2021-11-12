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
            'usia',
            'alamat',
            'users_id',
        ];

        
        public function users()
        {
            return $this->belongsTo('App\Models\User');
        }

}
