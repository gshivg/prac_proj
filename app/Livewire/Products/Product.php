<?php

namespace App\Livewire\Products;

use App\Models\product as ModelsProduct;
use Livewire\Component;

class Product extends Component
{
    public $slug;

    public function mount($id)
    {
        $this->slug = $id;
    }

    public function render()
    {
        $product = ModelsProduct::find($this->slug);

        return view('livewire.products.product')->with('product', $product);
    }
}
