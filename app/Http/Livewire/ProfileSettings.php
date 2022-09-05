<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ProfileSettings extends Component
{
    use WithFileUploads, LivewireAlert;

    public $name;
    public $email;
    public $date;
    public $phone;
    public $address;
    public $city;
    public $state;
    public $current_password;
    public $profileImage;
    public $iteration;

    public function mount()
    {
        $this->name = auth()->user()->name;
        $this->email = auth()->user()->email;
        $this->date = auth()->user()->birthday;
        $this->phone = auth()->user()->contact_no;
        $this->address = auth()->user()->address;
        $this->city = auth()->user()->city;
        $this->state = auth()->user()->state;
    }

    protected $rules = [
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'date' => 'required|date',
        'phone' => 'required|regex:/(09)[0-9]{9}/',
        'address' => 'required',
        'city' => 'required',
        'state' => 'required',
    ];

    public function updated($propertyName)
    {
        $user = User::findOrFail(auth()->user()->id);
        if($this->email == auth()->user()->email)
        {
            $this->validateOnly($propertyName, [
                'name' => 'required',
                'email' => 'required|email',
                'date' => 'required|date',
                'phone' => 'required|regex:/(09)[0-9]{9}/',
                'address' => 'required',
                'city' => 'required',
                'state' => 'required'
            ]);
        }elseif(!empty($this->profileImage)){
            $this->validateOnly($propertyName, [
                'name' => 'required',
                'profileImage' => 'image|max:1024', // 1MB Max
                'email' => 'required|email',
                'date' => 'required|date',
                'phone' => 'required|regex:/(09)[0-9]{9}/',
                'address' => 'required',
                'city' => 'required',
                'state' => 'required'
            ]);
        }else{
            if (Hash::make($this->current_password) != auth()->user()->password) {
                $this->validateOnly($propertyName, [
                    'name' => 'required',
                    'email' => 'required|email',
                    'date' => 'required|date',
                    'phone' => 'required|regex:/(09)[0-9]{9}/',
                    'address' => 'required',
                    'city' => 'required',
                    'state' => 'required',
                    'current_password' => ['required', 'customPassCheckHashed:'.$user->password]
                ]);
            }
            $this->validateOnly($propertyName);
        }
    }

    public function save()
    {
        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'contact_no' => $this->phone,
            'birthday' => $this->date,
            'address' => $this->address,
            'city' => $this->city,
            'state' => $this->state,
        ];
        $user = User::findOrFail(auth()->user()->id);

        $profileImageUp = $user->profile_img;

        if($profileImageUp != null){
            if (!empty($this->profileImage)) {
                $imageHashName = $this->profileImage->hashName();

                if($profileImageUp != 'default.png'){
                    $imagePath = public_path('storage/photos/'.$profileImageUp);
                    $imagePathThumb = public_path('storage/photos_thumb/'.$profileImageUp);

                    if(User::exists($imagePath) | User::exists($imagePathThumb)){
                        unlink($imagePath);
                        unlink($imagePathThumb);
                    }
                }

                // This is to save the filename of the image in the database
                $data = array_replace($data, [
                    'profile_img' => $imageHashName
                ]);

                // $this->profileImage->store('public/photos')->resize(300, 200);
                // Upload the main image
                $this->profileImage->store('public/photos');
                Storage::makeDirectory('public/photos_thumb');

                // Create a thumbnail of the image using Intervention Image Library
                $manager = new ImageManager();
                $image = $manager->make('storage/photos/'.$imageHashName)->resize(300, 200);
                $image->save('storage/photos_thumb/'.$imageHashName);
            }else{
                $data = array_replace($data, [
                    'profile_img' => $profileImageUp
                ]);
            }
        }

        if($this->email == auth()->user()->email){
            $this->validate([
                'name' => 'required',
                'email' => 'required|email',
                'date' => 'required|date',
                'phone' => 'required|regex:/(09)[0-9]{9}/',
                'address' => 'required',
                'city' => 'required',
                'state' => 'required',
            ]);
        }else{
            $this->validate();
        }

        if(!empty($this->current_password)){
            $this->validate([
                'current_password' => ['required', 'customPassCheckHashed:'.$user->password],
            ]);

            // $data = array_merge($data, [
            //     'password' => Hash::make($this->password)
            // ]);
        }

        $user->update($data);

        $this->alert('success', 'Save Successfully!', [
            'position' => 'top-end',
            'timer' => '10000',
            'toast' => true,
            'showConfirmButton' => true,
            'onConfirmed' => '',
            'confirmButtonText' => 'Close',
            'timerProgressBar' => true,
        ]);

        $this->dispatchBrowserEvent('close-modal');
        $this->emit('refreshParent');
    }

    private function cleanVars()
    {
        $this->iteration++;
    }

    public function render()
    {
        return view('livewire.profile-settings');
    }
}
