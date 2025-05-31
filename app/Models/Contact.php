<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'inquiry_type',
        'is_read',
        'read_at'
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'read_at' => 'datetime',
    ];

    public function markAsRead()
    {
        $this->update([
            'is_read' => true,
            'read_at' => now()
        ]);
    }

    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('inquiry_type', $type);
    }

    public function getFormattedCreatedAtAttribute()
    {
        return $this->created_at->format('M d, Y');
    }

    public function getInquiryTypeNameAttribute()
    {
        $types = [
            'general' => 'General Inquiry',
            'sales' => 'Vehicle Sales',
            'service' => 'Service & Maintenance',
            'parts' => 'Parts & Accessories'
        ];

        return $types[$this->inquiry_type] ?? ucfirst($this->inquiry_type);
    }
}
