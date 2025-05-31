<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryImage extends Model
{
    use HasFactory;
    protected $fillable = ['gallery_id', 'image_path', 'alt_text', 'order', 'is_featured'];
    protected $dates = ['deleted_at'];
    protected $appends = ['image_url'];

    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }

    public function getImageUrlAttribute()
    {
        if (!$this->image_path) {
            return asset('img/default-gallery.jpg');
        }
        return asset($this->image_path);
    }
}
