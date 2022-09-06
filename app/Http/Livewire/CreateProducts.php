<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class CreateProducts extends Component
{
    use WithFileUploads, LivewireAlert;

    public $iteration;
    public $category;
    public $product_name;
    public $price;
    public $qty;
    public $desc;
    public $productImage;
    public $modelId;

    protected $listeners = [
        'getModelId',
        'forcedCloseModal',
    ];

    public function getModelId($modelId)
    {
        $this->modelId = $modelId;

        $model = Product::findOrFail($this->modelId);
        
        $this->category = $model->category;
        $this->product_name = $model->product_name;
        $this->price = $model->price;
        $this->qty = $model->qty;
        $this->desc = $model->desc;
    }

    protected $rules = [
        'category' => 'required',
        'product_name' => 'required',
        'price' => 'required|numeric|min:1|max:3000',
        'qty' => 'required|numeric|min:1|max:50',
        'desc' => 'required',
    ];
    
    public function updated($propertyName)
    {
        if(!empty($this->productImage)){
            $this->validateOnly($propertyName, [
                'category' => 'required',
                'productImage' => 'image|max:1024', // 1MB Max
                'product_name' => 'required',
                'price' => 'required|numeric|min:1|max:3000',
                'qty' => 'required|numeric|min:1|max:50',
                'desc' => 'required',
            ]);
        }else{
            $this->validateOnly($propertyName);
        }
    }

    public function createproduct()
    {
        $data = [
            'user_id' => auth()->user()->id,
            'category' => $this->category,
            'product_name' => $this->product_name,
            'price' => $this->price,
            'qty' => $this->qty,
            'desc' => $this->desc,
            'product_img' => 'default.png'
        ];

        $this->validate();

        if (!empty($this->productImage)) {
            $imageHashName = $this->productImage->hashName();

            // This is to save the filename of the image in the database
            $this->validate([
                'productImage' => 'image|max:1024', // 1MB Max
            ]);

            $data = array_replace($data, [
                'product_img' => $imageHashName
            ]);

            // Upload the main image
            $this->productImage->store('public/products');
            Storage::makeDirectory('public/products_thumb');

            // Create a thumbnail of the image using Intervention Image Library
            $manager = new ImageManager();
            $image = $manager->make('storage/products/'.$imageHashName)->resize(300, 200);
            $image->save('storage/products_thumb/'.$imageHashName);
        }

        if ($this->modelId) {
            $modelUpdate = Product::findOrFail($this->modelId);
            $productImageUp = $modelUpdate->product_img;

            if($productImageUp != null){
                if (!empty($this->productImage)) {
                    $imageHashName = $this->productImage->hashName();

                    if($productImageUp != 'default.png'){
                        $imagePath = public_path('storage/products/'.$productImageUp);
                        $imagePathThumb = public_path('storage/products_thumb/'.$productImageUp);

                        if(Product::exists($imagePath) | Product::exists($imagePathThumb)){
                            unlink($imagePath);
                            unlink($imagePathThumb);
                        }
                    }

                    // This is to save the filename of the image in the database
                    $data = array_replace($data, [
                        'product_img' => $imageHashName
                    ]);
        
                    $this->productImage->store('public/products');
                }else{
                    $data = array_replace($data, [
                        'product_img' => $productImageUp
                    ]);
                }
            }

            $modelUpdate->update($data);
            $this->alert('success', 'Product Has Been Edited!', [
                'position' => 'bottom-end',
                'timer' => '5000',
                'toast' => true,
                'showConfirmButton' => true,
                'onConfirmed' => '',
                'timerProgressBar' => true,
                'confirmButtonText' => 'Confirm',
            ]);
        } else {
            Product::create($data);
            $this->alert('success', 'Product Has Been Listed!', [
                'position' => 'bottom-end',
                'timer' => '5000',
                'toast' => true,
                'showConfirmButton' => true,
                'onConfirmed' => '',
                'timerProgressBar' => true,
                'confirmButtonText' => 'Confirm',
            ]);
        }

        $this->emit('refreshParent');
        $this->dispatchBrowserEvent('close-modal');
        $this->cleanVars();
    }

    public function forcedCloseModal()
    {
        // This is to reset our public variables
        $this->cleanVars();

        // These will reset our error bags
        $this->resetErrorBag();
        $this->resetValidation();
    }

    private function cleanVars()
    {
        $this->iteration++;
        $this->modelId = null;
        $this->productImage = null;
        $this->category = null;
        $this->product_name = null;
        $this->desc = null;
    }

    public function render()
    {
        return view('livewire.create-products');
    }
}
