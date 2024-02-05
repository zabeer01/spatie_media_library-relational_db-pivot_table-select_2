<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class ProductMedia extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    protected $table = "product_media";
    protected $fillable = 
    [
        'product_id',
        'file_name',

    ];
}
