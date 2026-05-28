<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $fillable = ['amount', 'accepted_at', 'rejected_at'];

    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }

    public function bidder()
    {
        return $this->belongsTo(User::class, 'bidder_id');
    }

    public function scopeByMe(Builder $query): Builder
    {
        return $query->where('bidder_id', Auth::user()?->id);
    }
}
