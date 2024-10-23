<?php

namespace App\Models;

use Attribute;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use HasSlug;
    use InteractsWithMedia;

    protected $fillable = [
        'id',
        'category_id',
        'name',
        'slug',
        'description',
        'image_path',
        'values',
        'published'
    ];

    protected $casts = [
        'values' =>  'array',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
    public function getValuesAttribute($attr)
    {
        return array_column(json_decode($attr, 1), null, 'code');
    }
}
