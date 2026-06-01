<form class="panel form-grid" method="post" action="<?= e(url('admin/configuracoes')) ?>">
    <?= Csrf::field() ?>
    <?php View::partial('partials/flash'); ?>

    <div class="form-section form-section-open">
        <div class="section-label"><h2>Identidade e URL</h2><p>Dados usados no site e no Google.</p></div>
        <label class="full">URL do site
            <input name="site_url" value="<?= e($settings['site_url'] ?? '') ?>" placeholder="https://mesquitarealizacoes.com.br">
        </label>
    </div>

    <div class="form-section form-section-open">
        <div class="section-label"><h2>Canais de contato</h2><p>Aparecem na página de contato e no rodapé.</p></div>
        <label>Telefone <input name="telefone" value="<?= e($settings['telefone'] ?? '') ?>" placeholder="(16) 3203-3555"></label>
        <label>WhatsApp <input name="whatsapp" value="<?= e($settings['whatsapp'] ?? '') ?>" placeholder="5516912345678"></label>
        <label>E-mail <input type="email" name="email" value="<?= e($settings['email'] ?? '') ?>"></label>
        <label>E-mail para leads <input type="email" name="email_leads" value="<?= e($settings['email_leads'] ?? '') ?>">
            <small class="field-help">Recebe notificações de novos contatos. Se vazio usa o e-mail principal.</small>
        </label>
        <label class="full">Endereço
            <input name="endereco" value="<?= e($settings['endereco'] ?? '') ?>">
        </label>
    </div>

    <div class="form-section form-section-open">
        <div class="section-label"><h2>Redes sociais</h2></div>
        <label>LinkedIn <input name="linkedin" value="<?= e($settings['linkedin'] ?? '') ?>"></label>
        <label>Instagram <input name="instagram" value="<?= e($settings['instagram'] ?? '') ?>"></label>
        <label>Facebook <input name="facebook" value="<?= e($settings['facebook'] ?? '') ?>"></label>
    </div>

    <div class="form-section form-section-open">
        <div class="section-label"><h2>Analytics e Maps</h2></div>
        <label>Google Analytics ID <input name="ga_id" value="<?= e($settings['ga_id'] ?? '') ?>" placeholder="G-XXXXXXXXXX"></label>
        <label class="full">Google Maps embed (iframe src)
            <input name="maps_embed" value="<?= e($settings['maps_embed'] ?? '') ?>">
        </label>
    </div>

    <details class="form-section advanced">
        <summary><span>Avançado: envio de e-mails SMTP</span><small>A senha nunca é exibida.</small></summary>
        <div class="advanced-grid">
            <label>Host SMTP <input name="smtp_host" value="<?= e($settings['smtp_host'] ?? '') ?>"></label>
            <label>Usuário SMTP <input name="smtp_user" value="<?= e($settings['smtp_user'] ?? '') ?>"></label>
            <label>Senha SMTP <input type="password" name="smtp_pass" value="" placeholder="<?= !empty($settings['smtp_pass']) ? 'Cadastrada. Preencha para trocar.' : 'Informe a senha' ?>" autocomplete="new-password"></label>
            <label>Porta SMTP <input name="smtp_port" value="<?= e($settings['smtp_port'] ?? '') ?>" placeholder="587"></label>
        </div>
    </details>

    <div class="form-actions"><button class="button" type="submit">Salvar configurações</button></div>
</form>
