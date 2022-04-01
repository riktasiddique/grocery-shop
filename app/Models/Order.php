<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'image1',
        'title',
        'total_price',
        'quantity',
        'status' => 'boolean',
    ];
    // public function getIsPenddingAttribute()
    // {
    //     return $this->status == 1? true : false;
    // }
    public function creator()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id')->withDefault();
    }
    public function order(){
        return $this->belongsTo('App\Models\Order', 'order_id', 'id')->withDefault();
    }
    public function mainCategory(){
        return $this->belongsTo('App\Models\MainCategory', 'main_category_id', 'id')->withDefault();
    }
    public function subCategory(){
        return $this->belongsTo('App\Models\SubCategory', 'sub_category_id', 'id')->withDefault();
    }
    public function getIsPenddingAttribute()
    {
        return $this->status == 'Processing'? true : false;
    }
}
