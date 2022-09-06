<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Products extends Component
{
    use WithPagination,  LivewireAlert;
    
    public $searchTerm;
    public $viewModal;
    public $selectedProduct;
    public $currentProductId;
    public $currentProductName;
    public $show = false;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'getCurrentProduct'
    ];

    public function getCurrentProduct($currentProductId)
    {
        $this->currentProductId = $currentProductId;

        $currentProduct = Product::findOrFail($this->currentProductId);

        $this->currentProductName = $currentProduct->product_name;
    }

    public function createUpdateModal()
    {
        $this->viewModal = 'createUpdate';
        $this->show = true;
    }
 
    public function deleteModal()
    {
        $this->viewModal = 'delete';
        $this->show = true;
    }

    public function selectProduct($productId, $action)
    {
        $this->selectedProduct = $productId;
        
        if ($action == 'update') {
            $this->emit('getModelId', $this->selectedProduct);

            $this->createUpdateModal();
        }else{
            $this->emit('getCurrentProduct', $this->selectedProduct);

            $this->deleteModal();
        }
    }

    public function delete()
    {
        $deletePhoto = Product::findOrFail($this->currentProductId);

        $productImageDelete = $deletePhoto->product_img;

        if($productImageDelete != 'default.png'){
            $imagePath = public_path('storage/products/'.$productImageDelete);
            $imagePathThumb = public_path('storage/products_thumb/'.$productImageDelete);

            if(Product::exists($imagePath) | Product::exists($imagePathThumb)){
                unlink($imagePath);
                unlink($imagePathThumb);
            }
        }

        Product::destroy($this->selectedProduct);
        $this->alert('success', 'Product Has Been Deleted!', [
            'position' => 'bottom-end',
            'timer' => '5000',
            'toast' => true,
            'showConfirmButton' => true,
            'onConfirmed' => '',
            'timerProgressBar' => true,
            'confirmButtonText' => 'Confirm',
        ]);
        $this->dispatchBrowserEvent('close-modal');
    }
    
    public function render()
    {
        $products = Product::where('user_id', auth()->user()->id)->where(function($query){
            if(!empty($this->searchTerm)){
                $query->where('category', 'like', '%'.$this->searchTerm.'%');
                $query->orWhere('product_name', 'like', '%'.$this->searchTerm.'%');
            }
         })->latest()->paginate(10);

        return view('livewire.products', ['products' => $products]);
    }
}
