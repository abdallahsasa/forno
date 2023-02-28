<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class UserActivity extends Model
{
    use HasFactory;
    protected $guarded = ['id','created_at','updated_at'];

    public function user()
    {
        return $this->belongsTo('App\models\User');
    }

    public static function logActivity($activity_name)
    {
        self::create([
            'user_id' => Auth::id(),
            'activity_name' => $activity_name
        ]);
    }

}
