<!-- Modal reset_password -->
<div wire:ignore.self class="modal fade" id="resetPasswordModal" tabindex="-1" role="dialog"
     aria-labelledby="userResetPasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userResetPasswordModalLabel"><i class="fa fa-key"></i> Redefinir senha</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" wire:model="user_id">
                    <div class="form-group">
                        <label for="user_password">Nova senha</label>
                        <input type="password" class="form-control" wire:model="password" id="user_password"
                               placeholder="Digite a nova senha aqui" aria-describedby="passwordHelpBlock">
                        <small id="passwordHelpBlock" class="form-text text-muted">
                            A senha deve conter no mínimo 6 e no máximo 64 caracteres.
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
                <button type="button" wire:click.prevent="changePassword()" class="btn btn-primary close-modal"><i
                        class="fas fa-save"></i> Salvar alterações
                </button>
            </div>
        </div>
    </div>
</div>
