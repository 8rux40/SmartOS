<div class="container">
    @include('livewire.usuario.create')
    @include('livewire.usuario.edit')

    @if (session()->has('message'))
        <div class="alert alert-success" style="margin-top:30px;">
            <i class="far fa-thumbs-up"></i> {{ session('message') }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-9">
            <h3><i class="fas fa-users text-primary"></i> Usuários </h3>
        </div>
        <div class="col-md-3">
            <button wire:click="resetInputFields()" data-toggle="modal" data-target="#createModal"
                    class="btn btn-md bg-success text-light float-right"><i class="fas fa-plus"></i>&nbsp;&nbsp;Novo
            </button>
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
{{--                                <button class="btn btn-sm btn-dark" wire:click="changePassword({{$user}})"><i--}}
{{--                                        class="fas fa-key"></i> Redefinir senha--}}
{{--                                </button>--}}
                                <button data-toggle="modal" data-target="#updateModal"
                                        wire:click="edit({{ $user->id }})" class="btn btn-primary btn-sm">
                                    <i class="fas fa-edit"></i> Alterar
                                </button>
                                <button wire:click="confirmDelete({{ $user->id }})" class="btn btn-danger btn-sm"><i
                                        class="fas fa-trash"></i> Desativar
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
