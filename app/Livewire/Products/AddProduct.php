<?php

namespace App\Livewire\Products;

use App\Models\product;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;
use Livewire\Component;

class AddProduct extends Component
{
    #[Validate('required')]
    public $name;

    #[Validate('required')]
    public $category;

    #[Validate('required')]
    public $price;

    #[Validate('required')]
    public $best_before;

    public $category_id;

    public $description;

    public $categoriesDB;

    public function save()
    {
        $this->validate();

        foreach ($this->categoriesDB as $category) {
            if ($category->name === $this->category) {
                $this->category_id = $category->id;
            }
        }

        $this->category_id = DB::table('categories')->where('name', $this->category)->select(['id'])->get()[0]->id;

        $product = new product;
        $product->name = $this->name;
        $product->description = $this->description;
        $product->price = $this->price;
        $product->best_before_in_months = $this->best_before;
        $product->category_id = $this->category_id;
        $product->save();

        $this->redirectRoute('dashboard');
    }

    public function render()
    {
        $this->categoriesDB = DB::table('categories')->get();
        foreach ($this->categoriesDB as $category) {
            $categories[] = $category->name;
        }

        return view('livewire.products.add-product')->with('categories', $categories);
    }
}
