<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Usuario extends Component
{
    public $users, $name, $email, $user_id, $username, $password; 
    public $updateMode = false;

    public function render()
    {
        $this->users = User::all();
        return view('livewire.usuario', ['users' => $this->users]);
    }

    public function store(){
        $validatedData = $this->validate([
            'name' => 'required',
            'username' => 'unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:64'
        ]);
        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);
        session()->flash('message', 'Usuário criado com sucesso!');
        $this->resetInputFields();
        $this->emit('userStore');
    }

    public function edit($id){
        $this->updateMode = true;
        $user = User::find($id);
        $this->user_id = $user->id;
        $this->name = $user->name;
        $this->username = $user->username;
        $this->email = $user->email;
    }

    public function cancel(){
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function update(){
        $validatedData = $this->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email'
        ]);
        if ($this->user_id){
            $user = User::find($this->user_id);
            $user->update([
                'name' => $this->name,
                'email' => $this->email,
            ]);
            $this->updateMode = false;
            session()->flash('message', 'Usuário alterado com sucesso.');
            $this->resetInputFields();
            $this->emit('userUpdate');
        }
    }

    public function changePassword(){
        //
    }

    public function delete($id) {
        if ($id){
            User::find($id)->delete();
            session()->flash('message', 'Usuário inativado com sucesso.');
        }
    }

    public function resetInputFields(){
        $this->name = '';
        $this->username = '';
        $this->email = '';
        $this->password = '';
    }

}
