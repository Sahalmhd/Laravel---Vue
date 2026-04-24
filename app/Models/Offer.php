<?php

namespace App\Models;

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
}
