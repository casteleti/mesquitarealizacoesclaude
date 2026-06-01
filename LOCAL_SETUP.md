# Setup Local — mesquitarealizacoesclaude

Este projeto roda no Laragon com VirtualHost apontando para:

```
C:/laragon/www/mesquitarealizacoesclaude/public_html
```

URL local: `http://mesquitarealizacoesclaude.test/`

## 1. VirtualHost

```apache
<VirtualHost *:80>
    DocumentRoot "C:/laragon/www/mesquitarealizacoesclaude/public_html"
    ServerName mesquitarealizacoesclaude.test
    <Directory "C:/laragon/www/mesquitarealizacoesclaude/public_html">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

## 2. Banco de dados

Crie o banco: `mesquita_realizacoes_v2`

Importe: `database/schema.sql`

## 3. Configuração

Edite `public_html/config/database.php`:

```php
return [
    'host'     => 'localhost',
    'database' => 'mesquita_realizacoes_v2',
    'username' => 'root',
    'password' => '',
    'charset'  => 'utf8mb4',
];
```

## 4. URLs de teste

- `http://mesquitarealizacoesclaude.test/`
- `http://mesquitarealizacoesclaude.test/admin/login`
- `http://mesquitarealizacoesclaude.test/sitemap.xml`
- `http://mesquitarealizacoesclaude.test/robots.txt`

Credenciais padrão do admin:

```
E-mail: admin@mesquitarealizacoes.com.br
Senha: admin123
```
