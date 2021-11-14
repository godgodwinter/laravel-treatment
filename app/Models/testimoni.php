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
        ];

}
