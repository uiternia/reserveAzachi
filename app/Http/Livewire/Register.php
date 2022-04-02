<?php

namespace App\Http\Livewire;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Register extends Component
{
    public $name;
    public $email;
    public $password;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8',
    ];

    public function updated($propaty)
    {
        $this->validateOnly($propaty);
    }

    public function render()
    {
        return view('livewire.register');
    }
    public function register()
    {
        $this->validate();

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make('$this->password'),
        ]);

        session()->flash('message','登録okです');
        return to_route('livewire-test.index');

    }
}
