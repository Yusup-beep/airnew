<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Orders extends Model
{
    use HasFactory;
    protected $fillable = [
        'ur',
        'inn',
        'ogrn',
        'uradr',
        'bank',
        'bik',
        'chet',
        'delivery',
        'name',
        'phone',
        'email',
        'comment',
        'call',
        'items',
    ];
    protected $casts = [
        'items' =>  'array',
    ];
    protected $appends = ['products'];

    public function getItemsAttribute($items)
    {
        $items = json_decode($items, true);
        $ids = array_map(function ($v) {
            return $v['product_id'];
        }, $items);
        $p = Product::whereIn('id', $ids)->get();
        $p->each(function ($v, $a) use ($items) {
            $v['amount'] = $items[$a]['amount'];
            $v['image'] = blank($v->image_path) ? 'images/plug.png' : $v->image_path;
        });
        return $p;
    }
    public function getProductsAttribute()
    {
        return $this->items->first()->image_path;
    }
}
