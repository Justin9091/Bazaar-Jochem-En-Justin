<?php

namespace App\Models\advertisement;

use App\Models\Bid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Review;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Advertisement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'type', 'expires_at', 'user_id',
    ];
    public function bids()
    {
        return $this->hasMany(Bid::class)->orderBy('bid', 'desc');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function relatedAds() : BelongsToMany
    {
        return $this->belongsToMany(Advertisement::class, 'related_ads', 'advertisement_id', 'related_ad_id');
    }

    public function getReviews($advertisementId, $userId)
    {
        return Review::where('advertisement_id', $advertisementId)
            ->where('user_id', $userId)
            ->get();
    }

    public function rentadvertisement()
    {
        return $this->hasOne(RentAdvertisement::class);
    }
}
