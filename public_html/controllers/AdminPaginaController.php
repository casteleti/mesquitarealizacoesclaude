<?php

declare(strict_types=1);

class AdminPaginaController extends Controller
{
    private function editPage(string $pagina, string $view): void
    {
        $this->requireAdmin();
        $campos = PaginaConteudo::get($pagina);
        $this->view($view, compact('campos', 'pagina'));
    }

    private function savePage(string $pagina, string $redirect): void
    {
        $this->requireAdmin();
        $this->csrfVerify();

        $campos = $_POST;
        unset($campos['_token']);

        // Strip tags from all text fields, allow basic HTML for rich text fields
        $richTextFields = ['exp_texto', 'metodo_texto', 'prev_texto', 'qs_descricao'];
        $sanitized = [];
        foreach ($campos as $key => $value) {
            if (is_string($value)) {
                if (in_array($key, $richTextFields, true)) {
                    $sanitized[$key] = $value; // kept as-is, sanitize on output
                } else {
                    $sanitized[$key] = strip_tags($value);
                }
            } else {
                $sanitized[$key] = $value;
            }
        }

        // Uploads de imagem do hero (desktop + mobile).
        // Mapeia o campo de arquivo -> campo hidden que carrega o caminho atual.
        $imageFields = [
            'hero_imagem'        => 'hero_imagem_atual',
            'hero_imagem_mobile' => 'hero_imagem_mobile_atual',
        ];
        foreach ($imageFields as $field => $currentField) {
            $current = trim((string) ($sanitized[$currentField] ?? ''));
            if (!empty($_FILES[$field]['name'])) {
                try {
                    // Substitui e remove o arquivo antigo, se houver.
                    $sanitized[$field] = Upload::image($_FILES[$field], 'paginas', $current ?: null);
                } catch (RuntimeException $e) {
                    $this->flash('error', $e->getMessage());
                    $this->redirect($redirect);
                }
            } elseif ($current !== '') {
                // Sem novo upload: preserva a imagem existente (evita perdê-la ao salvar texto).
                $sanitized[$field] = $current;
            }
            unset($sanitized[$currentField]);
        }

        PaginaConteudo::save($pagina, $sanitized);
        $this->flash('success', 'Página atualizada.');
        $this->redirect($redirect);
    }

    public function home(): void              { $this->editPage('home',         'admin/pagina-home'); }
    public function saveHome(): void          { $this->savePage('home',         '/admin/paginas/home'); }
    public function quemSomos(): void         { $this->editPage('quem-somos',   'admin/pagina-quem-somos'); }
    public function saveQuemSomos(): void     { $this->savePage('quem-somos',   '/admin/paginas/quem-somos'); }
    public function setores(): void           { $this->editPage('setores',      'admin/pagina-setores'); }
    public function saveSetores(): void       { $this->savePage('setores',      '/admin/paginas/setores'); }
    public function obras(): void             { $this->editPage('obras',        'admin/pagina-obras'); }
    public function saveObras(): void         { $this->savePage('obras',        '/admin/paginas/obras'); }
    public function comoAtuamos(): void       { $this->editPage('como-atuamos', 'admin/pagina-como-atuamos'); }
    public function saveComoAtuamos(): void   { $this->savePage('como-atuamos', '/admin/paginas/como-atuamos'); }
    public function contato(): void           { $this->editPage('contato',      'admin/pagina-contato'); }
    public function saveContato(): void       { $this->savePage('contato',      '/admin/paginas/contato'); }
}
