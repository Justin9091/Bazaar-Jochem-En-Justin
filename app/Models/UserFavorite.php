<?php

namespace App\Models;

use App\Models\Advertisment\Advertisment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFavorite extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'advertisment_id',
    ];

    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function advertisment()
    {
        return $this->belongsTo(Advertisment::class);
    }
}
