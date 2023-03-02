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
    public function productTransaltion()
    {
        return $this->hasMany('App\Models\ProductTransaltion');
    }
    public function getNameAttribute($attribute)
    {
        if(request()->has('locale') && request('locale') != "en")
        {
            return $this->get_attribute_trans('name')->value ?? null;
        }
        return $attribute;
    }
    public function get_name_trans($attribute,$lang = "ar")
    {
        return  $this->productTransaltion()
            ->where('locale','=',$lang)->get('name');
    }
    public function getDescriptionAttribute($attribute)
    {
        if(request()->has('locale') && request('locale') != "en")
        {
            return $this->get_attribute_trans('description')->value ?? null;
        }
        return $attribute;
    }
    public function get_description_trans($attribute,$locale = "ar")
    {
        return  $this->productTransaltion()
            ->where('lang','=',$locale)->get('description');
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
