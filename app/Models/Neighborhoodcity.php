<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Neighborhoodcity extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public function state()
    {
        return $this->city->state->name;
    }
    public function country()
    {
        return $this->city->state->country->name;
    }
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}
