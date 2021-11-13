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
            // 'jadwaltreatment_id',
            'perawatan_id',
            'status',
            'tgl',
            'dokter_id',
            'ruangan',
            'jam',
            'pengingat',
        ];

        public function dokter()
        {
            return $this->belongsTo('App\Models\dokter');
        }

        public function perawatan()
        {
            return $this->belongsTo('App\Models\perawatan');
        }
}
