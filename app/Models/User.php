<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Shop;

class User extends Model
{
    use HasFactory;

    // protected $guarded = array('id');

    protected $fillable = ['id', 'name', 'email', 'password'];

    protected $primaryKey = 'id';
    public $incrementing = false;

    public static $rules = array(
        'id' => 'required',
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:6'
    );

    public function reservation()
    {
        return $this->hasOne(Reservation::class);
    }

    public function like()
    {
        return $this->hasMany('App\Http\Models\Like');
    }
}
