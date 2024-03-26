<?php

namespace App\Models;

use App\Models\advertisement\Advertisement;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'title', 'description', 'user_id', 'advertisement_id', 'score', 'reviewer', 'date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function advertisement()
    {
        return $this->belongsTo(Advertisement::class);
    }
}
