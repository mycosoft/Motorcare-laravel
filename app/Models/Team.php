<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Team extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'full_name',
        'position',
        'image',
    ];

    protected $appends = ['image_url'];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return asset('img/default-avatar.png');
        }
        return asset('uploads/team/' . $this->image);
    }

    public function getFormattedCreatedAtAttribute()
    {
        return $this->created_at->format('M d, Y');
    }
}
