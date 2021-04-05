

<div class="container">
    @if (session()->has('message'))
        <div class="alert alert-success" style="margin-top:30px;">
            <i class="far fa-thumbs-up"></i>  {{ session('message') }}
        </div>
    @endif
    <div class="row">
        <div class="col-md-9">
        <h3><i class="fas fa-users text-primary"></i> Usuários</li>
            
        </h3> 
        </div>
        <div class="col-md-3">
        {{-- <a href="#usuario.create" class="btn btn-md bg-success text-light float-right"> <i class="fas fa-plus"></i>&nbsp;&nbsp;Novo</a> --}}
        </div>      
    </div>
      <div class="mt-2"></div>
        <div class="row">
          <div class="col-md-12">
            <div class="responsive-table">
              <table class="table table-striped" id="clientes">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Login</th>
                    <th scope="col">E-mail</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                {{-- <button class="btn btn-sm btn-dark" wire:click="changePassword({{$user}})"><i class="fas fa-key"></i>  Redefinir senha</button> --}}
                                <button data-toggle="modal" data-target="#updateModal" wire:click="edit({{ $user->id }})" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i>  Alterar</button>
                                {{-- <button wire:click="delete({{ $user->id }})" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>  Inativar</button> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
          </div>          
        </div> 
        
        <!-- Modal update -->
        <div wire:ignore.self class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-edit"></i>  Alterar</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-group">
                                    <input type="hidden" wire:model="user_id">
                                    <label for="user_name">Name</label>
                                    <input type="text" class="form-control" wire:model="name" id="user_name" placeholder="Enter Name">
                                    @error('name') <span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group">
                                    <input type="hidden" wire:model="user_id">
                                    <label for="user_username">Login</label>
                                    <input type="text" class="form-control" wire:model="username" id="user_username" placeholder="Enter Name">
                                    @error('username') <span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group">
                                    <label for="user_email">E-mail</label>
                                    <input type="email" class="form-control" wire:model="email" id="user_email" placeholder="Enter Email">
                                    @error('email') <span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i>  Cancelar</button>
                            <button type="button" wire:click.prevent="update()" class="btn btn-primary close-modal"><i class="fas fa-save"></i>  Salvar alterações</button>
                        </div>
                </div>
            </div>
        </div>       
      </div>
