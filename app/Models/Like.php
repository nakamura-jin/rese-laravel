<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $guarded = array('id');

    public static $rules = array(
        'user_id' => 'required',
        'shop_id' => 'required',
    );

    public function user()
    {
        return $this->belongsTo('App\Http\Models\User');
    }

    public function shop()
    {
        return $this->belongsTo('App\Http\Models\Shop');
    }
}
