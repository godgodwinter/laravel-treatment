<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class treatment extends Model
{
        public $table = "treatment";

        use SoftDeletes;
        use HasFactory;

        protected $fillable = [
            'nama',
            'harga',
            'label',
            'photo',
        ];

}
