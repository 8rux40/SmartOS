<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Usuario extends Component
{
    public $users, $name, $email, $user_id, $username, $password, $password_confirmation;
    public $role;
    public $updateMode = false;

    protected $listeners = ['usuario:delete' => 'delete'];

    public function render()
    {
        $this->users = User::with('roles')->get();
        $this->role = Role::all()->first();
        return view('livewire.usuario', [
            'users' => $this->users,
            'roles' => Role::all()->pluck('name')
        ]);
    }

    public function store(){
        $validatedData = $this->validate([
            'name' => 'required',
            'username' => 'unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6|max:64',
            'role' => 'required'
        ]);
        $validatedData['password'] = Hash::make($validatedData['password']);
        User::create($validatedData)->syncRoles([$this->role]);
        $this->resetInputFields();
        $this->emit('userStore');
        $this->emit('swal:alert', [
            'type'  => 'success',
            'title'  => "Usuário criado com sucesso!",
            'timeout' => 3000,
        ]);
    }

    public function cancel(){
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function edit($id){
        $this->updateMode = true;
        $user = User::find($id);
        $this->user_id = $user->id;
        $this->role = $user->getRoleNames()->get(0);
        $this->name = $user->name;
        $this->username = $user->username;
        $this->email = $user->email;
    }

    public function update(){
        $validatedData = $this->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'role' => 'required'
        ]);
        if ($this->user_id){
            $user = User::find($this->user_id);
            $user->update([
                'name' => $this->name,
                'username' => $this->username,
                'email' => $this->email,
            ]);
            $user->syncRoles([$this->role]);
            $this->updateMode = false;
            $this->resetInputFields();
            $this->emit('userUpdate');
            $this->emit('swal:alert', [
                'type'  => 'success',
                'title'  => "Usuário alterado com sucesso!",
                'timeout' => 3000,
            ]);
        }
    }

    public function changePasswordModal($user_id){
        $this->user_id = $user_id;
    }

    public function changePassword(){
        $validatedData = $this->validate([
            'password' => 'required|confirmed|min:6|max:64',
        ]);
        if ($this->user_id){
            User::find($this->user_id)->update(['password' => Hash::make($validatedData['password'])]);
            $this->resetInputFields();
            $this->emit('userPasswordReset');
            $this->emit('swal:alert', [
                'type'  => 'success',
                'title'  => "Senha redefinida com sucesso!",
                'timeout' => 3000,
            ]);
        }
    }

    public function confirmDelete($id){
        $this->emit("swal:confirm", [
            'type'        => 'warning',
            'title'       => 'Tem certeza?',
            'text'        => "Você não poderá reverter isso!",
            'confirmText' => 'Sim, desativar!',
            'method'      => 'usuario:delete',
            'params'      => $id, // optional, send params to success confirmation
            'callback'    => '', // optional, fire event if no confirmed
        ]);
    }

    public function delete($id) {
        if ($id){
            User::find($id)->delete();
            $this->emit('swal:alert', [
                'type'  => 'success',
                'title'  => "Usuário desativado com sucesso!",
                'timeout' => 3000,
            ]);
        }
    }

    public function resetInputFields(){
        $this->name = '';
        $this->username = '';
        $this->email = '';
        $this->password = '';
        $this->password_confirmation = '';
    }

}
