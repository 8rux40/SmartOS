<!-- Modal update -->
<div wire:ignore.self class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="userUpdateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userUpdateModalLabel"><i class="fa fa-edit"></i>  Alterar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <input type="hidden" wire:model="user_id">
                            <label for="user_name">Nome</label>
                            <input type="text" class="form-control" wire:model="name" id="user_name" placeholder="Nome do usuário">
                            @error('name') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <input type="hidden" wire:model="user_id">
                            <label for="user_username">Login</label>
                            <input type="text" class="form-control" wire:model="username" id="user_username" placeholder="Login no sistema">
                            @error('username') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label for="user_email">E-mail</label>
                            <input type="email" class="form-control" wire:model="email" id="user_email" placeholder="Ex: fulano@dominio.com.br">
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