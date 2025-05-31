<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Brand extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'logo',
        'link',
    ];

    protected $appends = ['logo_url'];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function getLogoUrlAttribute()
    {
        if (!$this->logo) {
            return asset('img/default-brand.png');
        }
        return asset('uploads/brands/' . $this->logo);
    }

    public function getFormattedCreatedAtAttribute()
    {
        return $this->created_at->format('M d, Y');
    }
}
