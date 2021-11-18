<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class chatdetail extends Model
{
        public $table = "chatdetail";

        use SoftDeletes;
        use HasFactory;

        protected $fillable = [
            'users_id',
            'chat_id',
            'pesan',
        ];


        public function users()
        {
            return $this->belongsTo('App\Models\User');
        }

        public function chat()
        {
            return $this->belongsTo('App\Models\chat');
        }


}
