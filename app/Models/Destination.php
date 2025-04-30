<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Destination extends Model
{
    protected $fillable = ['name', 'latitude', 'longitude', 'trip_id', 'user_id'];
    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function activities()
    {
        return $this->hasMany(Activity::class);
    }
    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}
