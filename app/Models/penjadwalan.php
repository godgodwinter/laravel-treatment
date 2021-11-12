<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class penjadwalan extends Model
{
        public $table = "penjadwalan";

        use SoftDeletes;
        use HasFactory;

        protected $fillable = [
            'jadwaltreatment_id',
            'treatment_id',
            'member_id',
            'status',
            'pengingat',
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
