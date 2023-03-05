<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $fillable = array('name','description','image','active');
    public function translations()
    {
        return $this->hasMany('App\Models\CategoryTranslation');
    }
    public function getNameAttribute($attribute)
    {
        if(session()->has('locale') && session('locale') != "en")
        {
            return $this->get_name_trans(session('locale'))->name ?? $attribute;
        }
        return $attribute;
    }
    public function get_name_trans($lang)
    {
        return $this->translations()
            ->where('lang','=',$lang)
            ->first();
    }
    public function getDescriptionAttribute($attribute)
    {
        if(session()->has('locale') && session('locale') != "en")
        {
            return $this->get_description_trans(session('locale'))->description ?? $attribute;
        }
        return $attribute;
    }
    public function get_description_trans($lang)
    {
        return  $this->translations()
            ->where('lang','=',$lang)
            ->first('description');
    }
}
