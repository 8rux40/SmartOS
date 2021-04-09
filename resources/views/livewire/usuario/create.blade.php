<!-- Modal create -->
<div wire:ignore.self class="modal fade" id="createModal" tabindex="-1" role="dialog"
     aria-labelledby="userCreateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userCreateModalLabel"><i class="fa fa-plus"></i> Novo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" wire:model="user_id">
                    <div class="form-group">
                        <label for="user_name">Nome</label>
                        <input type="text" class="form-control" wire:model="name" id="user_name"
                               placeholder="Nome do usuário">
                        @error('name') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="user_email">E-mail</label>
                        <input type="email" class="form-control" wire:model="email" id="user_email"
                               placeholder="Ex: fulano@dominio.com.br">
                        @error('email') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="user_role">Grupo</label>
                        <select id="user_role" class="form-control" aria-label="Grupo do usuário" wire:model="role">
                            @if(sizeof($roles) > 0)
                                @foreach($roles as $role)
                                    <option value="{{ $role }}">{{ $role }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('role') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="user_username">Login</label>
                        <input type="text" class="form-control" wire:model="username" id="user_username"
                               placeholder="Login no sistema">
                        @error('username') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
{{--                    <div class="form-group">--}}
{{--                        <label for="user_password">Senha</label>--}}
{{--                        <input type="password" class="form-control" wire:model="password" id="user_password"--}}
{{--                               placeholder="Senha de no mínimo 6 caracteres">--}}
{{--                        @error('password') <span class="text-danger">{{ $message }}</span>@enderror--}}
{{--                    </div>--}}
                    <div class="form-group">
                        <label for="user_password">Nova senha</label>
                        <input type="password" class="form-control" wire:model="password" id="user_password"
                               placeholder="Digite a senha aqui" aria-describedby="passwordHelpBlock">
                        <small id="passwordHelpBlock" class="form-text text-muted">
                            A senha deve conter no mínimo 6 caracteres e no máximo 64.
                        </small>
                        @error('password') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="user_password_confirmation">Confirmar senha</label>
                        <input type="password" class="form-control" wire:model="password_confirmation" id="user_password_confirmation"
                               placeholder="Repita a nova senha aqui">
                        @error('password_confirmation') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary" data-dismiss="modal"><i
                        class="fas fa-times"></i> Cancelar
                </button>
                <button type="button" wire:click.prevent="store()" class="btn btn-primary close-modal"><i
                        class="fas fa-save"></i> Salvar alterações
                </button>
            </div>
        </div>
    </div>
</div>
