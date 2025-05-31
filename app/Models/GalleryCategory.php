<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description', 'is_active'];
    protected $dates = ['deleted_at'];

    public function galleries()
    {
        return $this->hasMany(Gallery::class, 'category_id');
    }
}
