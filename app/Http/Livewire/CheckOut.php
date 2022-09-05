<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class CheckOut extends Component
{
    use LivewireAlert;

    public $name;
    public $email;
    public $address;
    public $city;
    public $state;

    protected $listeners = [
        'refreshProducts' => '$refresh',
    ];

    protected $rules = [
        'name' => 'required',
        'email' => 'required|email',
        'address' => 'required',
        'city' => 'required',
        'state' => 'required',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount()
    {
        $this->name = auth()->user()->name;
        $this->email = auth()->user()->email;
        $this->address = auth()->user()->address;
        $this->city = auth()->user()->city;
        $this->state = auth()->user()->state;
    }

    public function placeOrder()
    {
        $this->validate();

        DB::transaction(function () {
            $order = new Order();
            $order->user_id = auth()->user()->id;
            $order->name = $this->name;
            $order->email = $this->email;
            $order->address = $this->address;
            $order->city = $this->city;
            $order->state = $this->state;
            $order->tracking_no = 'OR'. rand(1111,9999);
            $order->save();

            $cartProducts = Cart::session(auth()->user()->id)->getContent();

            foreach ($cartProducts as $cart) {
                $productTotal = Cart::get($cart->id)->getPriceSum();
                $product = Product::findOrFail($cart->id);
    
                $productData = [
                    'order_id' => $order->id,
                    'product_id' => $cart->id,
                    'qty' => $cart->quantity,
                    'price' => $productTotal,
                ];
                if($cart->quantity > $product->qty){
                    $error = $this->addError('qty'.$cart->id, $product->qty.' stock available.');
                    $error;
                }else{
                    OrderItem::create($productData);
                    Cart::session(auth()->user()->id)->remove($cart->id);
                    
                    $cartQty = $product->qty - $cart->quantity;

                    $data = [
                        'qty' => $cartQty
                    ];

                    $product->update($data);

                    $this->alert('success', 'Ordered Successfully!', [
                        'position' => 'center',
                        'toast' => true,
                        'showConfirmButton' => true,
                        'onConfirmed' => 'confirmed',
                        'confirmButtonText' => '<a href="/profile">Go To Your Profile</a>',
                    ]);
                }
            }
            if(!empty($error)){
                DB::rollBack();
            }
        });
    }

    public function render()
    {
        $cartOrders = Cart::session(auth()->user()->id)->getcontent();

        return view('livewire.check-out', ['cartOrders' => $cartOrders]);
    }
}
