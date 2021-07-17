<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\User;

class Shop extends Model
{
    use HasFactory;

    protected $guarded = array('id');

    public static $rules = array(
        'shopname' => 'required',
        'overview' => 'required|max:255',
        'image' => 'required',
        'area_id' => 'required',
        'genre_id' => 'required',
    );

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    // public function users() {
    //     return $this->belongsToMany(User::class, Like::class);
    // }

    public function like()
    {
        return $this->hasMany('App\Http\Models\Like');
    }
}
