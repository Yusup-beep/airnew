<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Configuration;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;

class CatalogController extends Controller
{
    public function index(Request $request, $slug, $id = false)
    {
        if ($request->method() == 'POST') {
            $r = $request->input();
            unset($r['_token']);
            if ($id) {
                $products = Category::findProducts($id, $r);
                return view('part.catalog-swiper-item')->with($products);
            } else {
                $category = Category::bySlug($slug);
                $ret = [];
                foreach ($category['category']->childrens as $k => $child) {
                    $products = $child->findProducts($child->id, $r);
                    if (!empty($products)) $ret['elements'][$k] = $products;
                }
                return view('part.catalog-swiper-items')->with($ret);
            }
        }
        if ($id) {
            $category = Category::findOrFail($id);
            if (count($category->childrens)) {
                return redirect()->route('catalog.id', ['slug' => $category->slug]);
            } else {
                $products = $category->findProducts($id);
                $keys = $category->keys();
                $agent = new Agent();
                $slider_items = $agent->isMobile() ? 2 : 7;
                return view('pages.catalog-item', compact('category', 'products', 'keys', 'slider_items'));
            }
        } else {
            $category = Category::bySlug($slug, 1);
        }
        return view('pages.catalog')->with($category);
    }
}
