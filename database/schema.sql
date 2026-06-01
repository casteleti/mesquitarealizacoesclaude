-- ============================================================
-- Mesquita Realizações — Schema completo
-- PHP 8.2 + MySQL 8 / MariaDB 10.4+
-- ============================================================

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ── Users ─────────────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS `users` (
    `id`         INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name`       VARCHAR(100) NOT NULL,
    `email`      VARCHAR(100) NOT NULL UNIQUE,
    `password`   VARCHAR(255) NOT NULL,
    `created_at` DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT IGNORE INTO `users` (`name`, `email`, `password`)
VALUES ('Admin', 'admin@mesquitarealizacoes.com.br',
        '$2y$12$GK8.R6YqMGXnKqD3wLBsLu3VFzTlKGqFqMx0JU2rrv.Xl7J0EF8B2');
-- senha: admin123

-- ── Login attempts ────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS `login_attempts` (
    `id`           INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `ip`           VARCHAR(45)  NOT NULL,
    `attempted_at` DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    INDEX `idx_ip_time` (`ip`, `attempted_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ── Configurações globais ─────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS `configuracoes` (
    `chave`      VARCHAR(100) NOT NULL,
    `valor`      TEXT,
    `updated_at` DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`chave`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT IGNORE INTO `configuracoes` (`chave`, `valor`) VALUES
('telefone',       ''),('whatsapp',    ''),('email',         ''),
('email_leads',    ''),('endereco',    ''),('linkedin',       ''),
('instagram',      ''),('facebook',    ''),('maps_embed',     ''),
('ga_id',          ''),('site_url',    'https://www.mesquitarealizacoes.com.br'),
('cta_titulo',     ''),('cta_texto',   ''),
('cta_btn1_texto', ''),('cta_btn1_link',''),
('cta_btn2_texto', ''),('cta_btn2_link',''),
('smtp_host',      ''),('smtp_port',   '587'),
('smtp_user',      ''),('smtp_pass',   '');

-- ── Banners ───────────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS `banners` (
    `id`                     INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `label`                  VARCHAR(100),
    `headline`               VARCHAR(150) NOT NULL,
    `subheadline`            TEXT,
    `imagem`                 VARCHAR(255),
    `botao_primario_texto`   VARCHAR(60),
    `botao_primario_link`    VARCHAR(255),
    `botao_secundario_texto` VARCHAR(60),
    `botao_secundario_link`  VARCHAR(255),
    `ativo`                  TINYINT(1)   NOT NULL DEFAULT 1,
    `ordem`                  SMALLINT     NOT NULL DEFAULT 0,
    `created_at`             DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at`             DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    INDEX `idx_ativo_ordem` (`ativo`, `ordem`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ── Setores ───────────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS `setores` (
    `id`              INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `title`           VARCHAR(100) NOT NULL,
    `slug`            VARCHAR(100) NOT NULL UNIQUE,
    `icone`           VARCHAR(50),
    `titulo_home`     VARCHAR(30),
    `descricao_curta` VARCHAR(80),
    `imagem`          VARCHAR(255),
    `titulo_pagina`   VARCHAR(60),
    `descricao`       TEXT,
    `botao_texto`     VARCHAR(50),
    `ativo`           TINYINT(1)   NOT NULL DEFAULT 1,
    `ordem`           SMALLINT     NOT NULL DEFAULT 0,
    `created_at`      DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at`      DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    INDEX `idx_ativo_ordem` (`ativo`, `ordem`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ── Obras ─────────────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS `obras` (
    `id`               INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `title`            VARCHAR(200) NOT NULL,
    `slug`             VARCHAR(200) NOT NULL UNIQUE,
    `cliente`          VARCHAR(100),
    `setor_id`         INT UNSIGNED,
    `localizacao`      VARCHAR(100),
    `subtitulo`        VARCHAR(200),
    `data_inicio`      VARCHAR(20),
    `data_conclusao`   VARCHAR(20),
    `status`           TINYINT(1)   NOT NULL DEFAULT 1 COMMENT '1=Concluida,2=Em andamento',
    `descricao`        TEXT,
    `escopo`           TEXT,
    `imagem_principal` VARCHAR(255),
    `destaque`         TINYINT(1)   NOT NULL DEFAULT 0,
    `ativo`            TINYINT(1)   NOT NULL DEFAULT 1,
    `ordem`            SMALLINT     NOT NULL DEFAULT 0,
    `seo_title`        VARCHAR(60),
    `seo_description`  VARCHAR(155),
    `seo_image`        VARCHAR(255),
    `created_at`       DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at`       DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    INDEX `idx_ativo_ordem` (`ativo`, `ordem`),
    INDEX `idx_setor`       (`setor_id`),
    CONSTRAINT `fk_obras_setor` FOREIGN KEY (`setor_id`) REFERENCES `setores` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ── Galeria de obras ──────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS `obra_imagens` (
    `id`         INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `obra_id`    INT UNSIGNED NOT NULL,
    `caminho`    VARCHAR(255) NOT NULL,
    `alt`        VARCHAR(200) NOT NULL DEFAULT '',
    `legenda`    VARCHAR(200) NOT NULL DEFAULT '',
    `ordem`      SMALLINT     NOT NULL DEFAULT 0,
    `created_at` DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    INDEX `idx_obra_ordem` (`obra_id`, `ordem`),
    CONSTRAINT `fk_imagens_obra` FOREIGN KEY (`obra_id`) REFERENCES `obras` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ── Diferenciais ─────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS `diferenciais` (
    `id`         INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `titulo`     VARCHAR(100) NOT NULL,
    `texto`      VARCHAR(255),
    `icone`      VARCHAR(50),
    `exibir_em`  TINYINT(1)   NOT NULL DEFAULT 1 COMMENT '1=Home,2=Quem Somos,3=Ambas',
    `ativo`      TINYINT(1)   NOT NULL DEFAULT 1,
    `ordem`      SMALLINT     NOT NULL DEFAULT 0,
    `created_at` DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    INDEX `idx_ativo_ordem` (`ativo`, `ordem`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ── Valores institucionais ────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS `valores` (
    `id`         INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `titulo`     VARCHAR(100) NOT NULL,
    `resumo`     VARCHAR(150),
    `texto`      TEXT,
    `icone`      VARCHAR(50),
    `topico_1`   VARCHAR(150),
    `topico_2`   VARCHAR(150),
    `topico_3`   VARCHAR(150),
    `ativo`      TINYINT(1)   NOT NULL DEFAULT 1,
    `ordem`      SMALLINT     NOT NULL DEFAULT 0,
    `created_at` DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    INDEX `idx_ativo_ordem` (`ativo`, `ordem`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ── Etapas do processo ────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS `etapas_processo` (
    `id`               INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `numero`           VARCHAR(10)  NOT NULL,
    `titulo`           VARCHAR(100) NOT NULL,
    `descricao`        TEXT,
    `icone`            VARCHAR(50),
    `bloco_titulo`     VARCHAR(100),
    `topico_1`         VARCHAR(200),
    `topico_2`         VARCHAR(200),
    `topico_3`         VARCHAR(200),
    `resultado_titulo` VARCHAR(100),
    `resultado_texto`  TEXT,
    `ativo`            TINYINT(1)   NOT NULL DEFAULT 1,
    `ordem`            SMALLINT     NOT NULL DEFAULT 0,
    `created_at`       DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at`       DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    INDEX `idx_ativo_ordem` (`ativo`, `ordem`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ── Cards de gestão ───────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS `gestao_cards` (
    `id`         INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `icone`      VARCHAR(50)  NOT NULL,
    `titulo`     VARCHAR(100) NOT NULL,
    `texto`      TEXT,
    `ativo`      TINYINT(1)   NOT NULL DEFAULT 1,
    `ordem`      SMALLINT     NOT NULL DEFAULT 0,
    `created_at` DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    INDEX `idx_ativo_ordem` (`ativo`, `ordem`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ── Leads ─────────────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS `leads` (
    `id`           INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `nome`         VARCHAR(100) NOT NULL,
    `empresa`      VARCHAR(100) NOT NULL,
    `email`        VARCHAR(100) NOT NULL,
    `telefone`     VARCHAR(20)  NOT NULL,
    `tipo_projeto` VARCHAR(50)  NOT NULL,
    `local`        VARCHAR(100),
    `mensagem`     TEXT         NOT NULL,
    `ip`           VARCHAR(45),
    `status`       TINYINT(1)   NOT NULL DEFAULT 1 COMMENT '1=Novo,2=Visualizado,3=Em contato,4=Convertido,5=Descartado',
    `created_at`   DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at`   DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    INDEX `idx_status`  (`status`),
    INDEX `idx_ip_time` (`ip`, `created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ── Conteúdos de páginas institucionais ───────────────────────────────────
CREATE TABLE IF NOT EXISTS `pagina_conteudos` (
    `id`         INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `pagina`     VARCHAR(50)  NOT NULL UNIQUE,
    `campos`     JSON         NOT NULL,
    `created_at` DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT IGNORE INTO `pagina_conteudos` (`pagina`, `campos`) VALUES
('home',         '{}'),('quem-somos',   '{}'),('setores',      '{}'),
('obras',        '{}'),('como-atuamos', '{}'),('contato',      '{}');

-- ── SEO por página ────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS `seo_metas` (
    `id`         INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `pagina`     VARCHAR(100) NOT NULL UNIQUE,
    `seo_title`  VARCHAR(60),
    `seo_desc`   VARCHAR(155),
    `og_title`   VARCHAR(60),
    `og_desc`    VARCHAR(155),
    `og_image`   VARCHAR(255),
    `robots`     VARCHAR(50)  DEFAULT 'index, follow',
    `updated_at` DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SET FOREIGN_KEY_CHECKS = 1;
