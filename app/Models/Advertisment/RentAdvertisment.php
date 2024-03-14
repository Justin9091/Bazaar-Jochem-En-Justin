<?php

namespace App\Models\Advertisment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentAdvertisment extends Advertisment
{
    use HasFactory;
    protected $table = 'rent';
    protected $fillable = ['from_date', 'to_date'];

    public function advertisement()
    {
        return $this->belongsTo(Advertisment::class);
    }
}
