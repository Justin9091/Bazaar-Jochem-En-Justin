<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    public $timestamps = false;
    protected $fillable = ['key', 'value'];

    public $key;
    public $value;
}
