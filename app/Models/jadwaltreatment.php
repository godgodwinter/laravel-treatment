<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class jadwaltreatment extends Model
{
        public $table = "jadwaltreatment";

        use SoftDeletes;
        use HasFactory;

        protected $fillable = [
            'hari',
            'jam',
            'ruangan',
        ];

}
