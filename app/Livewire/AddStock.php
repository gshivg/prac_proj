<?php

namespace App\Livewire;

use App\Models\Stock;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;
use Livewire\Component;

class AddStock extends Component
{
    #[Validate('required')]
    public $product;

    #[Validate('required')]
    public $manufacturing_date;

    #[Validate('required')]
    public $amount;

    public $allProducts;

    public $product_id;

    public $expiration_date;

    public $best_before;

    public function save()
    {
        $this->validate();

        foreach ($this->allProducts as $product) {
            if ($product->name === $this->product) {
                $this->product_id = $product->id;
                $this->best_before = $product->best_before_in_months;
                break;
            }
        }

        $myDate[] = explode('-', $this->manufacturing_date);

        $mDate = Carbon::createFromDate($myDate[0][2], $myDate[0][1], $myDate[0][0]);
        $eDate = $mDate;

        $eDate->addMonth($this->best_before);

        $newStockData = new Stock;
        $newStockData->product_id = $this->product_id;
        $newStockData->manufacturing_date = $this->manufacturing_date;
        $newStockData->expiration_date = $eDate->format('d-m-y');
        $newStockData->stock_value = $this->amount;

        $newStockData->save();

        $this->redirectRoute('dashboard');

    }

    public function render()
    {
        $this->allProducts = DB::table('products')->get();

        foreach ($this->allProducts as $product) {
            $products[] = $product->name;
        }

        return view('livewire.add-stock')->with('products', $products);
    }
}
