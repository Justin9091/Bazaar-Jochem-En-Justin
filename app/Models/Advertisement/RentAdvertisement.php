<?php

namespace App\Models\advertisement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentAdvertisement extends Advertisement
{
    use HasFactory;
    protected $table = 'rent';
    protected $fillable = ['advertisement_id','from_date', 'to_date'];

    public function advertisement()
    {
        return $this->belongsTo(Advertisement::class);
    }
}
