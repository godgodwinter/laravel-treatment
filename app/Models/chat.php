<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class chat extends Model
{
        public $table = "chat";

        use SoftDeletes;
        use HasFactory;

        protected $fillable = [
            'member_id',
            'users_id',
            'status',
            'tgladminread',
            'tglmemberread',
        ];


        public function users()
        {
            return $this->belongsTo('App\Models\User');
        }
        public function chatdetail()
        {
            return $this->hasMany('App\Models\chatdetail');
        }

        public function member()
        {
            return $this->belongsTo('App\Models\member');
        }


}
