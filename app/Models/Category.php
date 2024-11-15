<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Models\Product;
use App\Observers\CategoryObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

#[ObservedBy([CategoryObserver::class])]
class Category extends Model implements HasMedia
{
    use HasSlug;
    use InteractsWithMedia;

    protected $fillable = [
        'id',
        'title',
        'name',
        'slug',
        'parent_id',
        'image_path',
        'description_inside_page',
        'description',
        'info',
        'keywords',
        'announcement',
        'show_keys',
        'up_text',
        'down_text1',
        'down_text2',
        'wide',
        'order',
    ];

    protected $casts = [
        'show_keys' =>  'array',
        'description_inside_page' =>  'array',
    ];

    public function childrens(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }


    public function scopeParentGet($query)
    {
        return Category::whereParentId(null);
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
    public static function findProducts($id, $filter = [], $index = 0, $count = null)
    {
        $category = self::findOrFail($id);
        $not_many = (!empty($filter) && !is_array($filter[array_key_first($filter)]));
        $products = $category->products->where('published', true)->skip($index)->take($count);
        $filter = array_filter($filter, fn($v) => !is_null($v) && $v !== '');
        if (!empty($filter)) {
            $products = $products->filter(function ($product) use ($filter, $not_many) {
                if ($not_many) {
                    foreach ($filter as $key => $value) {
                        if (empty($value)) break;
                        if (is_array($product->values[$key]['value'])) {
                            foreach ($product->values[$key]['value'] as $val) {
                                $needle = (float) str_replace(',', '.', $val);
                                if ($ret[$key] = $needle == (float) str_replace(',', '.', $value)) break;
                            }
                        } else {
                            $needle = (float) str_replace(',', '.', $product->values[$key]['value']);
                            $ret[$key] = $needle == (float) str_replace(',', '.', $value);
                        }
                    }
                } else {
                    foreach ($filter as $key => $value) {
                        if (!array_key_exists('from', $value)) $value[0] = -100000000;
                        else $value[0] = (float)str_replace(',', '.', $value['from']);
                        if (!array_key_exists('to', $value)) $value[1] = 100000000;
                        else $value[1] = (float)str_replace(',', '.', $value['to']);
                        if (is_array($product->values[$key]['value'])) {
                            foreach ($product->values[$key]['value'] as $val) {
                                $needle = (float) str_replace(',', '.', $val);
                                if ($ret[$key] = $needle >= (float) str_replace(',', '.', $value[0]) && $needle <= (float) str_replace(',', '.', $value[1])) break;
                            }
                        } else {
                            $needle = (float) str_replace(',', '.', $product->values[$key]['value']);
                            $ret[$key] = $needle >= (float) str_replace(',', '.', $value[0]) && $needle <= (float) str_replace(',', '.', $value[1]);
                        }
                    }
                }
                return isset($ret) && !in_array(false, $ret);
            });
            if (!count($products)) {
                return [];
            }
        }

        $products = $products->map(function ($product) {
            $ret = array_merge($product->values, $product->getAttributes(), ['category' => $product->category->name]);
            return $ret;
        })->toArray();
        return $products;
    }
    public function keys($category = 0)
    {
        if ($category == 0) $category = $this;
        else $category = self::find($category);
        $show_keys = empty($category->show_keys) ? $category->childrens->first()?->show_keys : $category->show_keys;
        if (empty($show_keys)) return [];
        while (blank($category->products->first())) $category = $category->childrens->first();
        foreach ($category->products->first()->values as $v) {
            if (!array_key_exists('code', $v)) return [];
            if (array_key_exists($v['code'], $show_keys) && $show_keys[$v['code']] == true) {
                $keys[$v['code']] = $v['name'];
            } else $keys[$v['code']] = false;
        }
        if (!isset($keys)) return [];
        return call_user_func(function ($k, $sk) {
            if (empty($k)) return [];
            foreach ($k as $key => $value) {
                $v[$key] = [$value, $sk[$key]];
            }
            uasort($v, [self::class, 'sort_search_keys']);
            foreach ($v as &$value) {
                $value[1] = preg_replace('/\d/', '', $value[1]);
            }
            return $v;
        }, array_filter($keys), $show_keys);
        return array_filter($keys);
    }
    private static function sort_search_keys($a, $b)
    {
        $a[1] = preg_replace('/\D/', '', $a[1]);
        $b[1] = preg_replace('/\D/', '', $b[1]);
        return $a[1] == $b[1] ? 0 : ($a[1] < $b[1] ? 1 : -1);
    }
    public function getImagePathAttribute($value)
    {
        if (explode('/', request()->path())[0] == 'admin') return $value;
        return '/storage/' . $value;
    }
    public static function bySlug($slug, $with_keys = false)
    {
        $category['category'] = self::whereSlug($slug)->where('published', true)->first();
        // $ret = self::findProducts(count($category->childrens) > 0 ? $category->childrens[0]->id : $category->id);
        $category['sorted'] = $category['category']->childrens->where('published', true)->sortBy('order');
        $category['keys'] = $with_keys ? $category['category']->keys($category['category']->id) : false;
        return $category;
    }
    public static function findByString($search_string)
    {
        $res = self::where('name', 'like', '%' . $search_string . '%')->get();
        return $res;
    }
}
