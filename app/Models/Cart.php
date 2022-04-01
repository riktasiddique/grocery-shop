<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    public function mainCategory(){
        return $this->belongsTo('App\Models\MainCategory', 'main_category_id', 'id')->withDefault();
    }
    public function subCategory(){
        return $this->belongsTo('App\Models\SubCategory', 'sub_category_id', 'id')->withDefault();
    }
}
