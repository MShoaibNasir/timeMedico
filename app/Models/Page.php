<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Page extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['title','title_ur','banner_title','banner_title_ur','description','description_ur','image','meta_title','meta_description','meta_keywords','status'];
    
    protected static function booted()
    {
        static::creating(function ($page) {
            $page->slug = static::generateUniqueSlug($page->title);
        });
    
        static::updating(function ($page) {
            if ($page->isDirty('title')) {
                $page->slug = static::generateUniqueSlug($page->title, $page->id);
            }
        });

        
    }
    
    protected static function generateUniqueSlug($title, $excludeId = null)
    {
        $slug = Str::slug($title);
        $original = $slug;
        $count = 1;
    
        while (static::where('slug', $slug)
            ->when($excludeId, fn($q) => $q->where('id', '!=', $excludeId))
            ->exists()) {
            $slug = $original . '-' . $count++;
        }
    
        return $slug;
    }

}


