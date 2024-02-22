<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'firstname', 'infix', 'lastname', 'user_id', 'city', 'streetname', 'streetnumber',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

