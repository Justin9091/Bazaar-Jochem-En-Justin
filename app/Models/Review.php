<?php

namespace App\Models;

use App\Models\Advertisment\Advertisment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'title', 'description', 'user_id', 'advertisment_id', 'score', 'reviewer', 'date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function advertisment()
    {
        return $this->belongsTo(Advertisment::class);
    }
}
