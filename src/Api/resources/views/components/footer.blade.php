@vite(['resources/scss/footer.scss'])

<nav class="footer">
    <div class="copyright">
        <span>© {{ date('Y') }} Techlab</span>
    </div>
    <div class="content">
        <div class="makers">
            <span>Gemaakt door MBO studenten:</span>
            <a class="links" href="https://www.linkedin.com/in/ahmad-natfaji/" target="_blank">
                <i class="fa-brands fa-linkedin"></i>
                Ahmad Natfaji
            </a>
            <a class="links" href="https://www.linkedin.com/in/leon-watertor/" target="_blank">
                <i class="fa-brands fa-linkedin"></i>
                Leon Watertor
            </a>
            <a class="links" href="https://www.linkedin.com/in/milan-bruul-1ab312233/" target="_blank">
                <i class="fa-brands fa-linkedin"></i>
                Milan Bruul
            </a>
        </div>
        <div class="logos">
            <img src="{{ env('APP_URL') }}/images/logo.svg" alt="logo" class="logo">
            <img src="{{ env('APP_URL') }}/images/logo_RegiusCollege.png" alt="logo" class="logo">
        </div>
    </div>
</nav>
