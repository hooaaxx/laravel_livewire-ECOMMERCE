<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Cart;

class ShowCart extends Component
{
    use LivewireAlert;

    public $delete;
    public $selectedProduct;
    public $currentProductId;
    public $currentProductName;
    public $test;

    protected $listeners = [
        'refreshProducts' => '$refresh',
        'getCurrentProduct'
    ];
    
    public function getCurrentProduct($currentProductId)
    {
        $this->currentProductId = $currentProductId;

        $userId = auth()->user()->id;
        $currentProduct = Cart::session($userId)->get($this->currentProductId);

        // $this->currentProductName = $currentProduct->name;
    }

    public function selectProduct($productId, $action)
    {
        $this->selectedProduct = $productId;
        $userId = auth()->user()->id;
        $currentProduct = Cart::session($userId)->get($this->selectedProduct);

        if ($action == 'delete') {
            // $this->emit('getCurrentProduct', $this->selectedProduct);

            Cart::session($userId)->remove($this->selectedProduct);

            $this->alert('info','Removed from cart!', [
                'position' => 'top',
                'timer' => 5000,
                'toast' => true,
                'showConfirmButton' => true,
                'onConfirmed' => '',
                'confirmButtonText' => 'Confirm',
                'timerProgressBar' => true,
            ]);
        }
        if($action == 'Increment'){

            $productDetails = Product::findOrFail($this->selectedProduct);

            if($currentProduct->quantity < $productDetails->qty){
                Cart::session($userId)->update($this->selectedProduct, array(
                    'quantity' => +1,
                ));
            }else{
                $this->addError('qty'.$this->selectedProduct, $productDetails->qty.' stock available.');
            }
        }
        if($action == 'Decrement'){
            
            if($currentProduct->quantity > 1){
                Cart::session($userId)->update($this->selectedProduct, array(
                    'quantity' => -1,
                ));
            }
        }
    }

    public function checkout()
    {
        $userId = auth()->user()->id;
        $cartProducts = Cart::session($userId)->getContent();
        $productDetails = Product::select('id', 'qty')
                            ->whereIn('id', $cartProducts->pluck('id'))
                            ->pluck('qty', 'id');
        
        foreach ($cartProducts as $cartProduct) {
            $cartId = $cartProduct->id;

            if(!isset($productDetails[$cartProduct->id]) || $productDetails[$cartProduct->id] < $cartProduct->quantity){
                $error = $this->addError('qty'.$cartProduct->id, $productDetails[$cartProduct->id] .' stock available.');
                $error;
            }
        }

        if(empty($error)){
            return redirect()->route('checkout');
        }
        
    }
    
    public function render()
    {
        $userId = auth()->user()->id;
        $items = Cart::session($userId)->getContent()->sortBy('count')->reverse();

        return view('livewire.show-cart', ['items' => $items]);
    }
}
