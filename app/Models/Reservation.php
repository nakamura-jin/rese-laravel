<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Reservation extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'shop_id', 'date', 'time', 'people'];

    public static $rules = array(
        'user_id' => 'required',
        'shop_id' => 'required',
        'date' => 'required|date|after:today',
        'time' => 'required',
        'people' => 'required'
    );
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
