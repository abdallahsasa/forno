<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteProfile extends Model
{
    use HasFactory;
    protected $table = 'website_profile';
    protected $fillable = array('location','email','number','facebook','instagram','snapchat');
}
