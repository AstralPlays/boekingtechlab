@vite(['resources/scss/footer.scss'])

<nav class="footer">
    <div class="content">
        <div class="makers">
            <span>Gemaakt door MBO studenten:</span>
            <a class="links" href="https://www.linkedin.com/in/ahmad-natfaji/" target="_blank">
                <span class="fa-stack">
                    <i class="fa-solid fa-square fa-stack-2x"></i>
                    <i class="fa-brands fa-linkedin-in fa-stack-1x"></i>
                </span>Ahmad Natfaji
            </a>
            <a class="links" href="https://www.linkedin.com/in/leon-watertor/" target="_blank">
                <span class="fa-stack">
                    <i class="fa-solid fa-square fa-stack-2x"></i>
                    <i class="fa-brands fa-linkedin-in fa-stack-1x"></i>
                </span>Leon Watertor
            </a>
            <a class="links" href="https://www.linkedin.com/in/milan-bruul-1ab312233/" target="_blank">
                <span class="fa-stack">
                    <i class="fa-solid fa-square fa-stack-2x"></i>
                    <i class="fa-brands fa-linkedin-in fa-stack-1x"></i>
                </span>Milan Bruul
            </a>
        </div>
        <div class="logos">
            <img src="{{ env('APP_URL') }}/images/logo.svg" alt="logo" class="logo techlab">
            <img src="{{ env('APP_URL') }}/images/logo_RegiusCollege.png" alt="logo" class="logo regius">
        </div>
    </div>
    <hr>
    <div class="copyright">
        <span>© {{ date('Y') }} Techlab</span>
    </div>
</nav>
