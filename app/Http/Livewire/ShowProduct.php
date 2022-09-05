<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Cart;

class ShowProduct extends Component
{
    use LivewireAlert;
    public $products;
    public $counter;

    public function increment()
    {
        foreach($this->products as $product){
            $productId = $product->id;
            $productQty = $product->qty;
        }

        if($this->counter < $productQty){
            $this->counter++;
        }else{
            $this->addError('qty'.$productId, $productQty.' stock available.');
        }
    }

    public function decrement()
    {
        if($this->counter > 1){
            $this->counter--;
        }
    }

    public function mount()
    {
        $this->counter = 1;
    }

    public function addToCart()
    {
        foreach($this->products as $product){
            $productId = $product->id;
        }
        
        $qty = $this->counter;
        $productDetails = Product::findOrFail($productId);
        $userId = auth()->user()->id; // or any string represents user identifier

        Cart::session($userId)->add(array(
            'id' => $productDetails->id, // inique row ID
            'name' => $productDetails->product_name,
            'price' => $productDetails->price,
            'quantity' => $qty,
            'attributes' => array(),
            'associatedModel' => $productDetails
        ));

        $this->alert('success', 'Added to cart', [
            'position' => 'center',
            'timer' => '10000',
            'toast' => true,
            'showConfirmButton' => true,
            'onConfirmed' => '',
            'confirmButtonText' => 'Close',
            'timerProgressBar' => true,
            'width' => '250',
        ]);
        
        $this->emit('refreshProducts');
    }

    public function render()
    {
        foreach($this->products as $product){
            $productId = $product->id;
        }

        $cart = Cart::session(auth()->user()->id)->get($productId);

        return view('livewire.show-product', ['cart' => $cart]);
    }
}
