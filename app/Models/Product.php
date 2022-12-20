<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\ProductController;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name','content','content_en','content_ru','content_kz','price','img','user_id', 'category_id'];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function reviews(){
        return $this->hasMany(Review::class);
    }

    public function basketUser(){
        return $this->belongsToMany(User::class,'product_user')
            ->withPivot('number','color');
    }

}
