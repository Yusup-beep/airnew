<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Livewire\Component;

class ProductsSlider extends Component
{
    public $slug;
    public int $id;

    public $showRows = false;
    public $keys = [];
    public $text = '';
    public $fromto = 0;
    public $products;

    public $allproducts = [];

    public $slidesPerView = 7;
    public $searchdata = [];
    public $oldsearchdata = [];
    public $index = 0;
    public $count = 10;
    public $message = '';
    public $keyword = '';
    public $button_class = [];
    public $button_classes = ['', 'd-none', 'swiper-button-disabled'];

    public function mount(Request $request)
    {
        $this->slug = $request->slug;
        $this->id = is_null($request->id) ? 0 : $request->id;
        if (!$this->fromto) $this->search();
    }
    public function next()
    {
        if ($this->index + $this->slidesPerView < $this->count) $this->index++;
        $this->search();
    }
    public function prev()
    {
        if ($this->index) $this->index--;
        $this->search();
    }
    public function search($id = false)
    {
        if (empty($this->products) || ($this->oldsearchdata != $this->searchdata)) {
            if ($this->id) {
                $products = Category::findProducts($this->id, $this->searchdata);
            } elseif (!$this->keyword) {
                $category = Category::bySlug($this->slug);
                $products = [];
                foreach ($category['category']->childrens as $k => $child) {
                    $prod = $child->findProducts($child->id, $this->searchdata);
                    if (!empty($prod)) {
                        $products = array_merge($prod, $products);
                    }
                }
            } else {
                $products = Product::where('name', 'like', '%' . $this->keyword . '%')
                    ->orWhereHas('category', function ($query) {
                        return $query->where('name', 'like', '%' . $this->keyword . '%');
                    })
                    ->orWhereHas('category.parent', function ($query) {
                        return $query->where('name', 'like', '%' . $this->keyword . '%');
                    })
                    ->get();
                $products = $products->map(function ($product) {
                    $ret = array_merge($product->values, $product->getAttributes(), ['category' => $product->category->name]);
                    return $ret;
                })->groupBy('category');
                $category = new Category();
                foreach ($products as $key => $value) {
                    $products[$key]['keys'] = $category->find(['id' => $value->first()['category_id']])->first()->keys();
                }
                $products = $products->toArray();
            }
            $this->allproducts = $products;
            $this->count = count($products);
        }

        if ($id) $this->allproducts = array_filter($this->allproducts, function ($v) use ($id) {
            return $v['id'] != $id;
        });

        // if (array_key_exists(0, $this->allproducts)) {
        //     $this->products = array_slice($this->allproducts, $this->index, $this->slidesPerView);
        // } else {
        //     foreach ($this->allproducts as $key => $value) {
        //         $this->products[$key] = array_slice($value, $this->index, $this->slidesPerView);
        //     }
        // }

        $this->products = array_values($this->allproducts);

        $this->button_class[0] = count($this->allproducts) < $this->slidesPerView ? 'd-none' : '';
        $this->button_class[1] = $this->index == 0 ? 'swiper-button-disabled' : '';
        $this->button_class[2] = $this->index + $this->slidesPerView == $this->count ? 'swiper-button-disabled' : '';
        if (is_null($this->products) || count($this->products) == 0) $this->products = 'Товары не найдены';

        $this->dispatch('search');
    }

    public function render()
    {
        $this->products = $this->products ?: '';
        return view('part.products-slider', ['button_class' => $this->button_class]);
    }
}
