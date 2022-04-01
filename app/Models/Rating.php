<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'product_id',
        'stars_rated'
    ];
    public function mainCategory(){
        return $this->belongsTo('App\Models\MainCategory', 'main_category_id', 'id')->withDefault();
    }
    public function subCategory(){
        return $this->belongsTo('App\Models\SubCategory', 'sub_category_id', 'id')->withDefault();
    }
    public function order(){
        return $this->belongsTo('App\Models\Order', 'order_id', 'id')->withDefault();
    }
}
