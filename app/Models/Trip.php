<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Trip extends Model
{
    protected $fillable = ['name', 'start_date', 'end_date', 'user_id'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function destinations()
    {
        return $this->hasMany(Destination::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function collaborators()
    {
    return $this->belongsToMany(User::class);
    }
}