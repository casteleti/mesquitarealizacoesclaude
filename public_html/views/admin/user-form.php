<?php $isEdit = !empty($item); ?>
<form class="panel form-grid" method="post"
      action="<?= e($isEdit ? url('admin/usuarios/' . $item['id'] . '/edit') : url('admin/usuarios/create')) ?>">
    <?= Csrf::field() ?>
    <?php View::partial('partials/form-errors'); ?>

    <div class="form-section form-section-open">
        <div class="section-label"><h2>Dados do usuário</h2><p>Controle quem pode acessar o painel.</p></div>

        <label>Nome
            <input name="name" value="<?= e(old('name', $item['name'] ?? '')) ?>" required>
            <small class="field-help">Nome exibido no topo do painel.</small>
        </label>
        <label>E-mail de acesso
            <input type="email" name="email" value="<?= e(old('email', $item['email'] ?? '')) ?>" required>
            <small class="field-help">Usado para fazer login.</small>
        </label>
        <label>Senha
            <input type="password" name="password" <?= $isEdit ? '' : 'required' ?> autocomplete="new-password">
            <small class="field-help"><?= $isEdit ? 'Preencha apenas para trocar a senha.' : 'Defina uma senha inicial.' ?></small>
        </label>
    </div>

    <div class="form-actions">
        <button class="button" type="submit">Salvar alterações</button>
        <a href="<?= e(url('admin/usuarios')) ?>">Cancelar</a>
    </div>
</form>
