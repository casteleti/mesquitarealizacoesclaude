/* Header compacto ao rolar (logo encolhe + barra estreita) */
(function () {
    var header = document.querySelector('[data-site-header]');
    if (!header) return;

    function onScroll() {
        header.classList.toggle('is-compact', window.pageYOffset > 24);
    }

    onScroll();
    window.addEventListener('scroll', onScroll, { passive: true });
})();

/* Menu mobile */
(function () {
    var button = document.querySelector('[data-menu-toggle]');
    var menu = document.querySelector('[data-menu]');
    if (!button || !menu) return;

    function setState(open) {
        menu.classList.toggle('is-open', open);
        document.body.classList.toggle('menu-open', open);
        button.setAttribute('aria-expanded', open ? 'true' : 'false');
        button.setAttribute('aria-label', open ? 'Fechar menu' : 'Abrir menu');
    }

    function closeMenu() { setState(false); }

    button.addEventListener('click', function () {
        setState(!menu.classList.contains('is-open'));
    });

    menu.querySelectorAll('a').forEach(function (link) {
        link.addEventListener('click', closeMenu);
    });

    // Botão X dentro do drawer
    var closeBtn = menu.querySelector('[data-menu-close]');
    if (closeBtn) closeBtn.addEventListener('click', closeMenu);

    // Fecha ao tocar fora do menu (no overlay escuro)
    document.addEventListener('click', function (event) {
        if (!menu.classList.contains('is-open')) return;
        if (menu.contains(event.target) || button.contains(event.target)) return;
        closeMenu();
    });

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') closeMenu();
    });
})();

(function () {
    var root = document.querySelector('[data-sector-tabs]');
    if (!root) return;

    var tabs = Array.prototype.slice.call(root.querySelectorAll('[data-sector-tab]'));
    var panels = Array.prototype.slice.call(root.querySelectorAll('[data-sector-panel]'));

    function activate(tab) {
        var target = tab.getAttribute('data-target');
        tabs.forEach(function (item) {
            var active = item === tab;
            item.classList.toggle('is-active', active);
            item.setAttribute('aria-selected', active ? 'true' : 'false');
        });

        panels.forEach(function (panel) {
            var active = panel.id === target;
            panel.classList.toggle('is-active', active);
            panel.hidden = !active;
        });
    }

    tabs.forEach(function (tab) {
        tab.addEventListener('click', function () {
            activate(tab);
        });

        tab.addEventListener('keydown', function (event) {
            var current = tabs.indexOf(tab);
            var next = null;
            if (event.key === 'ArrowDown' || event.key === 'ArrowRight') {
                next = tabs[(current + 1) % tabs.length];
            }
            if (event.key === 'ArrowUp' || event.key === 'ArrowLeft') {
                next = tabs[(current - 1 + tabs.length) % tabs.length];
            }
            if (!next) return;
            event.preventDefault();
            next.focus();
            activate(next);
        });
    });
})();

(function () {
    var root = document.querySelector('[data-works-filter]');
    if (!root) return;

    var search = root.querySelector('[data-works-search]');
    var sector = root.querySelector('[data-works-sector]');
    var count = root.querySelector('[data-works-count]');
    var cards = Array.prototype.slice.call(document.querySelectorAll('[data-work-card]'));
    var empty = document.querySelector('[data-works-empty]');

    function normalize(value) {
        return (value || '')
            .toString()
            .normalize('NFD')
            .replace(/[\u0300-\u036f]/g, '')
            .toLowerCase()
            .trim();
    }

    function update() {
        var term = normalize(search ? search.value : '');
        var selectedSector = sector ? sector.value : '';
        var visible = 0;

        cards.forEach(function (card) {
            var matchesText = !term || normalize(card.getAttribute('data-search')).indexOf(term) !== -1;
            var matchesSector = !selectedSector || card.getAttribute('data-sector-id') === selectedSector;
            var show = matchesText && matchesSector;
            card.hidden = !show;
            if (show) visible += 1;
        });

        if (count) {
            count.innerHTML = 'Exibindo <strong>' + visible + '</strong> ' + (visible === 1 ? 'obra' : 'obras');
        }
        if (empty) {
            empty.hidden = visible !== 0;
        }
    }

    if (search) search.addEventListener('input', update);
    if (sector) sector.addEventListener('change', update);
    update();
})();

/* Contact form — AJAX submit */
(function () {
    var form = document.getElementById('contact-form');
    if (!form) return;

    var btn    = form.querySelector('.contact-submit');
    var result = document.getElementById('form-result');

    function showResult(msg, type) {
        result.textContent = msg;
        result.className   = type === 'success' ? 'is-success' : 'is-error';
    }

    form.addEventListener('submit', function (e) {
        e.preventDefault();
        btn.disabled    = true;
        btn.textContent = 'Enviando…';
        result.className = '';
        result.textContent = '';

        var data = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            body: data,
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(function (res) { return res.json(); })
        .then(function (json) {
            if (json.success) {
                showResult(json.message || 'Mensagem enviada com sucesso!', 'success');
                form.reset();
            } else {
                var erros = json.errors ? Object.values(json.errors).join(' · ') : (json.message || 'Verifique os campos e tente novamente.');
                showResult(erros, 'error');
            }
        })
        .catch(function () {
            showResult('Erro ao enviar. Verifique sua conexão e tente novamente.', 'error');
        })
        .finally(function () {
            btn.disabled    = false;
            btn.textContent = 'Enviar mensagem';
        });
    });
})();
