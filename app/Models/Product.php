<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = array('name','description','price','active','image');

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
    public function translations()
    {
        return $this->hasMany('App\Models\ProductTranslation');
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
    public function media()
    {
        return $this->hasMany('App\Models\ProductMedia');
    }

    public function tags()
    {
        return $this->hasMany('App\Models\ProductTag');
    }
    public function prices()
    {
        return $this->hasMany('App\Models\ProductPrices');
    }
    public function regularprice()
    {
        $regularprice  = ProductPrices::where(['product_id ' => $this->getKey(),'size'=> 'Regular']);
        return $regularprice;
    }
    public function attributes()
    {
        return $this->belongsToMany('App\Models\Attribute')->withPivot('values');
    }

    public function reviews()
    {
        return $this->hasMany('App\Models\ProductReview');
    }

    public function parent()
    {
        return self::find($this->parent_id);
    }

    public static function getActiveProducts()
    {
        return self::where(['status' => 'active','stock_status' => 'in'])->where('stock_quantity','>',0);
    }

    public function in_stock()
    {
        return $this->stock_status == "in";
    }

    public function get_images()
    {
        return $this->media()->where(['media_type' => 'image'])->get();
    }

    public function get_videos()
    {
        return $this->media()->where(['media_type' => 'video'])->get();
    }

}
