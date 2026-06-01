<details class="form-section advanced">
    <summary>
        <span>Avançado: Google e redes sociais</span>
        <small>Opcional. Use apenas quando quiser personalizar como esta página aparece fora do site.</small>
    </summary>
    <div class="advanced-grid">
        <label>Título para Google <input name="meta_title" value="<?= e($item['meta_title'] ?? $page['meta_title'] ?? '') ?>"><small class="field-help">Se ficar vazio, o sistema usa o título principal.</small></label>
        <label class="full">Descrição para Google <textarea name="meta_description" rows="3"><?= e($item['meta_description'] ?? $page['meta_description'] ?? '') ?></textarea><small class="field-help">Resumo curto para resultados de busca. Evite texto muito longo.</small></label>
        <label class="full">Link canônico <input name="canonical_url" value="<?= e($item['canonical_url'] ?? $page['canonical_url'] ?? '') ?>"><small class="field-help">Normalmente deixe em branco para o sistema usar a URL correta.</small></label>
        <label>Título para redes sociais <input name="og_title" value="<?= e($item['og_title'] ?? $page['og_title'] ?? '') ?>"><small class="field-help">Título usado ao compartilhar em WhatsApp, Facebook ou LinkedIn.</small></label>
        <label>Imagem para redes sociais <input name="og_image" value="<?= e($item['og_image'] ?? $page['og_image'] ?? '') ?>"><small class="field-help">Caminho da imagem de compartilhamento, quando houver.</small></label>
        <label class="full">Descrição para redes sociais <textarea name="og_description" rows="3"><?= e($item['og_description'] ?? $page['og_description'] ?? '') ?></textarea><small class="field-help">Texto de apoio usado no compartilhamento.</small></label>
        <label>Tipo de schema <input name="schema_type" value="<?= e($item['schema_type'] ?? $page['schema_type'] ?? 'Organization') ?>"><small class="field-help">Campo técnico. Mantenha o padrão se não houver orientação de SEO.</small></label>
        <div class="toggle-row">
            <label class="check"><input type="checkbox" name="robots_index" value="1" <?= !isset($item['robots_index'], $page['robots_index']) || (int)($item['robots_index'] ?? $page['robots_index'] ?? 1) ? 'checked' : '' ?>> Permitir aparecer no Google</label>
            <label class="check"><input type="checkbox" name="robots_follow" value="1" <?= !isset($item['robots_follow'], $page['robots_follow']) || (int)($item['robots_follow'] ?? $page['robots_follow'] ?? 1) ? 'checked' : '' ?>> Permitir seguir links</label>
        </div>
    </div>
</details>
