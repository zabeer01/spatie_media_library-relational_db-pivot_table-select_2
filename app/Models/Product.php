<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    protected $table = "products";
    protected $fillable = 
    [
        'product_name',
        'product_description'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_product','product_id','category_id');
    }


}
