<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class perawatan extends Model
{
        public $table = "perawatan";

        use SoftDeletes;
        use HasFactory;

        protected $fillable = [
            'treatment_id',
            'member_id',
            'status',
            'tglbayar',
        ];

        public function member()
        {
            return $this->belongsTo('App\Models\member');
        }

        public function treatment()
        {
            return $this->belongsTo('App\Models\treatment');
        }
}
