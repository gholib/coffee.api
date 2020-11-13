<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $guarded = [];

    public function scopeToday($query)
    {
        return $query->where('sale_date', Carbon::today());
    }

    public function menuItem()
    {
        return $this->belongsTo(MenuItem::class);
    }
}
