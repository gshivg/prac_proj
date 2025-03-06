<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('components.layouts.app.sidebar', function ($view) {
            $prods = DB::table('products')->orderBy('name')->get();

            $products = [];

            foreach ($prods as $prod) {
                $product_category = DB::table('categories')->select(['name'])->where('id', $prod->category_id)->get();
                $product_category = substr($product_category[0]->name, 0, 3);
                $products[] = ['name' => $prod->name, 'category' => $product_category, 'id' => $prod->id];
            }

            $view->with('products', $products);
        });
    }
}
