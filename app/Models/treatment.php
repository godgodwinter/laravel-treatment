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
        'stok',
        'photo',
        'reminderweek',
    ];

    public function perawatan()
    {
        return $this->hasMany('App\Models\perawatan');
    }

    public function getPhotoAttribute($value)
    {

        return url('storage/' . $value);
    }
}
