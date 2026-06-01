<main class="auth-card">
    <span class="auth-eyebrow">Mesquita Realizações</span>
    <h1>Acessar painel</h1>
    <p>Informe suas credenciais para editar o site.</p>
    <?php View::partial('partials/flash'); ?>
    <form method="post" action="<?= e(url('admin/login')) ?>">
        <?= Csrf::field() ?>
        <label>E-mail <input type="email" name="email" required autofocus></label>
        <label>Senha <input type="password" name="password" required></label>
        <button class="button" type="submit">Entrar</button>
    </form>
</main>
