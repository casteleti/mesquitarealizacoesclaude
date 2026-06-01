(function () {
    var toggle = document.querySelector('[data-admin-menu-toggle]');
    var close = document.querySelector('[data-admin-menu-close]');
    var sidebar = document.querySelector('[data-admin-sidebar]');
    if (toggle && sidebar) {
        toggle.addEventListener('click', function () {
            sidebar.classList.toggle('is-open');
        });
    }
    if (close && sidebar) {
        close.addEventListener('click', function () {
            sidebar.classList.remove('is-open');
        });
    }

    document.querySelectorAll('[data-confirm]').forEach(function (form) {
        form.addEventListener('submit', function (event) {
            if (!confirm(form.getAttribute('data-confirm'))) {
                event.preventDefault();
            }
        });
    });

    document.querySelectorAll('[data-preview-input]').forEach(function (input) {
        input.addEventListener('change', function () {
            var target = input.getAttribute('data-preview-target');
            var preview = target ? document.getElementById(target) : input.closest('form').querySelector('[data-preview]');
            var warningTarget = input.getAttribute('data-warning-target');
            var warning = warningTarget ? document.getElementById(warningTarget) : null;
            if (!preview || !input.files || !input.files[0]) return;
            var objectUrl = URL.createObjectURL(input.files[0]);
            preview.src = objectUrl;
            preview.hidden = false;

            if (!warning) return;
            warning.hidden = true;
            warning.textContent = '';

            var minWidth = parseInt(input.getAttribute('data-image-min-width') || '0', 10);
            var minHeight = parseInt(input.getAttribute('data-image-min-height') || '0', 10);
            var expectedRatio = parseFloat(input.getAttribute('data-image-ratio') || '0');
            if (!minWidth && !minHeight && !expectedRatio) return;

            var image = new Image();
            image.onload = function () {
                var ratio = image.width / image.height;
                var messages = [];
                if ((minWidth && image.width < minWidth) || (minHeight && image.height < minHeight)) {
                    messages.push('A imagem esta menor que o recomendado (' + image.width + 'x' + image.height + 'px).');
                }
                if (expectedRatio && Math.abs(ratio - expectedRatio) > 0.12) {
                    messages.push('A proporcao esta fora do padrao recomendado.');
                }
                if (messages.length) {
                    warning.textContent = messages.join(' ');
                    warning.hidden = false;
                }
                URL.revokeObjectURL(objectUrl);
            };
            image.src = objectUrl;
        });
    });
})();
