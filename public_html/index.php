<?php

declare(strict_types=1);

define('ROOT', __DIR__);
define('APP_VERSION', '1.0.0');

require_once ROOT . '/includes/bootstrap.php';

$router = new Router();

// ── Public routes ──────────────────────────────────────────────────────────

$router->get('/',                   'HomeController@index');
$router->get('/quem-somos',         'PageController@quemSomos');
$router->get('/setores',            'PageController@setores');
$router->get('/setores/{slug}',     'PageController@setor');
$router->get('/obras',              'WorkController@index');
$router->get('/obras/{slug}',       'WorkController@show');
$router->get('/como-atuamos',       'PageController@comoAtuamos');
$router->get('/contato',            'ContactController@index');
$router->post('/contato',           'ContactController@send');
$router->get('/sitemap.xml',        'SitemapController@index');

// Legacy redirect
$router->get('/sobre', function () {
    header('Location: /quem-somos', true, 301);
    exit;
});

// ── Admin routes ───────────────────────────────────────────────────────────

$router->get('/admin',              'AdminAuthController@redirectLogin');
$router->get('/admin/login',        'AdminAuthController@loginForm');
$router->post('/admin/login',       'AdminAuthController@login');
$router->get('/admin/logout',       'AdminAuthController@logout');

$router->get('/admin/dashboard',    'AdminDashboardController@index');

// Banners
$router->get('/admin/banners',                  'AdminBannerController@index');
$router->get('/admin/banners/create',           'AdminBannerController@create');
$router->post('/admin/banners/create',          'AdminBannerController@store');
$router->get('/admin/banners/{id}/edit',        'AdminBannerController@edit');
$router->post('/admin/banners/{id}/edit',       'AdminBannerController@update');
$router->post('/admin/banners/{id}/delete',     'AdminBannerController@delete');
$router->post('/admin/banners/{id}/toggle',     'AdminBannerController@toggle');
$router->post('/admin/banners/reorder',         'AdminBannerController@reorder');

// Setores
$router->get('/admin/setores',                  'AdminSectorController@index');
$router->get('/admin/setores/create',           'AdminSectorController@create');
$router->post('/admin/setores/create',          'AdminSectorController@store');
$router->get('/admin/setores/{id}/edit',        'AdminSectorController@edit');
$router->post('/admin/setores/{id}/edit',       'AdminSectorController@update');
$router->post('/admin/setores/{id}/delete',     'AdminSectorController@delete');
$router->post('/admin/setores/{id}/toggle',     'AdminSectorController@toggle');
$router->post('/admin/setores/reorder',         'AdminSectorController@reorder');

// Obras
$router->get('/admin/obras',                    'AdminWorkController@index');
$router->get('/admin/obras/create',             'AdminWorkController@create');
$router->post('/admin/obras/create',            'AdminWorkController@store');
$router->get('/admin/obras/{id}/edit',          'AdminWorkController@edit');
$router->post('/admin/obras/{id}/edit',         'AdminWorkController@update');
$router->post('/admin/obras/{id}/delete',       'AdminWorkController@delete');
$router->post('/admin/obras/{id}/toggle',       'AdminWorkController@toggle');
$router->post('/admin/obras/reorder',           'AdminWorkController@reorder');
$router->post('/admin/obras/{id}/imagens',      'AdminWorkController@addImage');
$router->post('/admin/obras/imagens/{id}/delete', 'AdminWorkController@deleteImage');
$router->post('/admin/obras/imagens/reorder',   'AdminWorkController@reorderImages');

// Diferenciais
$router->get('/admin/diferenciais',                 'AdminDiferencialController@index');
$router->get('/admin/diferenciais/create',          'AdminDiferencialController@create');
$router->post('/admin/diferenciais/create',         'AdminDiferencialController@store');
$router->get('/admin/diferenciais/{id}/edit',       'AdminDiferencialController@edit');
$router->post('/admin/diferenciais/{id}/edit',      'AdminDiferencialController@update');
$router->post('/admin/diferenciais/{id}/delete',    'AdminDiferencialController@delete');
$router->post('/admin/diferenciais/{id}/toggle',    'AdminDiferencialController@toggle');
$router->post('/admin/diferenciais/reorder',        'AdminDiferencialController@reorder');

// Valores
$router->get('/admin/valores',                  'AdminValorController@index');
$router->get('/admin/valores/create',           'AdminValorController@create');
$router->post('/admin/valores/create',          'AdminValorController@store');
$router->get('/admin/valores/{id}/edit',        'AdminValorController@edit');
$router->post('/admin/valores/{id}/edit',       'AdminValorController@update');
$router->post('/admin/valores/{id}/delete',     'AdminValorController@delete');
$router->post('/admin/valores/{id}/toggle',     'AdminValorController@toggle');
$router->post('/admin/valores/reorder',         'AdminValorController@reorder');

// Processo
$router->get('/admin/processo',                 'AdminProcessController@index');
$router->get('/admin/processo/create',          'AdminProcessController@create');
$router->post('/admin/processo/create',         'AdminProcessController@store');
$router->get('/admin/processo/{id}/edit',       'AdminProcessController@edit');
$router->post('/admin/processo/{id}/edit',      'AdminProcessController@update');
$router->post('/admin/processo/{id}/delete',    'AdminProcessController@delete');
$router->post('/admin/processo/{id}/toggle',    'AdminProcessController@toggle');
$router->post('/admin/processo/reorder',        'AdminProcessController@reorder');

// Gestão
$router->get('/admin/gestao',                   'AdminGestaoController@index');
$router->get('/admin/gestao/create',            'AdminGestaoController@create');
$router->post('/admin/gestao/create',           'AdminGestaoController@store');
$router->get('/admin/gestao/{id}/edit',         'AdminGestaoController@edit');
$router->post('/admin/gestao/{id}/edit',        'AdminGestaoController@update');
$router->post('/admin/gestao/{id}/delete',      'AdminGestaoController@delete');
$router->post('/admin/gestao/{id}/toggle',      'AdminGestaoController@toggle');
$router->post('/admin/gestao/reorder',          'AdminGestaoController@reorder');

// Leads
$router->get('/admin/leads',                    'AdminLeadController@index');
$router->get('/admin/leads/{id}',               'AdminLeadController@show');
$router->post('/admin/leads/{id}/status',       'AdminLeadController@updateStatus');
$router->post('/admin/leads/{id}/delete',       'AdminLeadController@delete');

// Páginas do site
$router->get('/admin/paginas/home',             'AdminPaginaController@home');
$router->post('/admin/paginas/home',            'AdminPaginaController@saveHome');
$router->get('/admin/paginas/quem-somos',       'AdminPaginaController@quemSomos');
$router->post('/admin/paginas/quem-somos',      'AdminPaginaController@saveQuemSomos');
$router->get('/admin/paginas/setores',          'AdminPaginaController@setores');
$router->post('/admin/paginas/setores',         'AdminPaginaController@saveSetores');
$router->get('/admin/paginas/obras',            'AdminPaginaController@obras');
$router->post('/admin/paginas/obras',           'AdminPaginaController@saveObras');
$router->get('/admin/paginas/como-atuamos',     'AdminPaginaController@comoAtuamos');
$router->post('/admin/paginas/como-atuamos',    'AdminPaginaController@saveComoAtuamos');
$router->get('/admin/paginas/contato',          'AdminPaginaController@contato');
$router->post('/admin/paginas/contato',         'AdminPaginaController@saveContato');

// Setores em destaque (Home)
$router->get('/admin/setores-destaque',         'AdminDestaqueController@index');
$router->post('/admin/setores-destaque',        'AdminDestaqueController@save');

// SEO
$router->get('/admin/seo',                      'AdminSeoController@index');
$router->post('/admin/seo/{pagina}',            'AdminSeoController@save');

// Configurações
$router->get('/admin/configuracoes',            'AdminSettingsController@index');
$router->post('/admin/configuracoes',           'AdminSettingsController@save');

// Usuários
$router->get('/admin/usuarios',                 'AdminUserController@index');
$router->get('/admin/usuarios/create',          'AdminUserController@create');
$router->post('/admin/usuarios/create',         'AdminUserController@store');
$router->get('/admin/usuarios/{id}/edit',       'AdminUserController@edit');
$router->post('/admin/usuarios/{id}/edit',      'AdminUserController@update');
$router->post('/admin/usuarios/{id}/delete',    'AdminUserController@delete');

// ── Dispatch ───────────────────────────────────────────────────────────────

// Normalize /index.php → / (permite acesso direto ao site quando index.html existe)
$requestUri = $_SERVER['REQUEST_URI'];
if (preg_match('#^/index\.php(/.*)?(\?.*)?$#', $requestUri, $m)) {
    $requestUri = ($m[1] ?? '/') . ($m[2] ?? '');
    if ($requestUri === '') $requestUri = '/';
}

$router->dispatch($requestUri, $_SERVER['REQUEST_METHOD']);
