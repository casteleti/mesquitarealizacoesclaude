<section class="error-404">
    <div class="container error-404-inner">

        <div class="error-404-icon" aria-hidden="true">
            <svg width="200" height="200" viewBox="0 0 512 512" fill="none" stroke="currentColor" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" xmlns="http://www.w3.org/2000/svg">
                <path d="M29.31,215.54L8.85,250.97c-1.8,3.11-1.8,6.95,0,10.06l119.22,206.49c1.79,3.12,5.12,5.04,8.71,5.04h49.29"/>
                <path d="M46.81,185.23l81.26-140.75c1.79-3.12,5.12-5.04,8.71-5.04h238.44c3.59,0,6.92,1.92,8.71,5.04l21.47,37.18"/>
                <path d="M422.9,111.97l80.25,139c1.8,3.11,1.8,6.95,0,10.06L383.93,467.52c-1.79,3.12-5.12,5.04-8.71,5.04H221.07"/>
                <polyline points="440.78,304.07 468.53,256 362.27,71.94 149.73,71.94 43.47,256 149.73,440.06 362.27,440.06 423.28,334.38"/>
                <path d="M186.119,283.988h-83.234c-4.162,0-6.768-4.5-4.696-8.11l49.446-86.14c1.861-3.242,5.313-5.241,9.051-5.241c5.764,0,10.436,4.673,10.436,10.436v132.569"/>
                <path d="M406.487,283.988h-83.234c-4.162,0-6.768-4.5-4.696-8.11l49.446-86.14c1.861-3.242,5.313-5.241,9.051-5.241c5.764,0,10.436,4.673,10.436,10.436v132.569"/>
                <path d="M291.332,287.771c0,21.944-17.789,39.732-39.732,39.732c-21.943,0-39.732-17.789-39.732-39.732v-63.541c0-21.943,17.789-39.732,39.732-39.732c21.944,0,39.732,17.789,39.732,39.732V287.771z"/>
            </svg>
        </div>

        <span class="eyebrow">Erro 404</span>
        <h1 class="error-404-title">Ops! Este endereço<br>não existe.</h1>
        <p class="error-404-desc">O link que você acessou pode ter sido removido, renomeado ou nunca existiu. Verifique o endereço digitado ou volte para o início.</p>

        <div class="error-404-actions">
            <a class="button" href="<?= e(url('/')) ?>">Ir para a home</a>
            <a class="button button-outline" href="<?= e(url('contato')) ?>">Fale conosco</a>
        </div>

    </div>
</section>
