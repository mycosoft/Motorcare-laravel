<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'title', 'slug', 'description', 'is_featured', 'is_active'];
    protected $dates = ['deleted_at'];

    public function category()
    {
        return $this->belongsTo(GalleryCategory::class, 'category_id');
    }

    public function images()
    {
        return $this->hasMany(GalleryImage::class)->orderBy('order');
    }
}
