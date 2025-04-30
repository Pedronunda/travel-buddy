<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Activity extends Model
{
    protected $fillable = ['name', 'description', 'scheduled_at', 'destination_id', 'user_id'];
    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}