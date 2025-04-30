<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Vote extends Model
{
    protected $fillable = ['user_id', 'destination_id', 'is_upvote'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }
}
