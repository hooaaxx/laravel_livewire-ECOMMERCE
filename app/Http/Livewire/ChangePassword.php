<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ChangePassword extends Component
{
    use LivewireAlert;
    public $password;
    public $password_confirmation;
    public $current_password;

    protected $rules = [
        'password' => 'required|min:8|max:20|confirmed',
        'password_confirmation' => 'required'
    ];
    
    public function updated($propertyName)
    {
        $user = User::findOrFail(auth()->user()->id);

        if (Hash::make($this->current_password) != auth()->user()->password) {
            $this->validateOnly($propertyName, [
                'current_password' => ['required', 'customPassCheckHashed:'.$user->password]
            ]);
        }
        $this->validateOnly($propertyName);
    }

    public function changepass()
    {
        $data = [];

        $this->validate();

        $user = User::findOrFail(auth()->user()->id);

        if (Hash::check($this->current_password, auth()->user()->password)) {
            $data = array_merge($data, [
                'password' => Hash::make($this->password)
            ]);

            $user->update($data);
            $this->alert('success', 'Change Password Successfully!', [
                'position' => 'top-end',
                'timer' => '10000',
                'toast' => true,
                'showConfirmButton' => true,
                'onConfirmed' => '',
                'confirmButtonText' => 'Close',
                'timerProgressBar' => true,
            ]);
            $this->emit('refreshParent');
            $this->dispatchBrowserEvent('close-modal');
        }
    }

    public function render()
    {
        return view('livewire.change-password');
    }
}
