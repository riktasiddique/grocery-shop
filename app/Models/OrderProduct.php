<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'user_id',
        'image1',
        'price',
        'quantity',
        'category_id',
        'sub_category_id',
    ];
    public function order(){
        return $this->belongsTo('App\Models\Order', 'order_id', 'id')->withDefault();
    }
    public function mainCategory(){
        return $this->belongsTo('App\Models\MainCategory', 'main_category_id', 'id')->withDefault();
    }
    public function subCategory(){
        return $this->belongsTo('App\Models\SubCategory', 'sub_category_id', 'id')->withDefault();
    }
}
