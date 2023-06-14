@vite(['resources/scss/background.scss'])

<div class="outerContainer">
    <div class="innerContainer">
    </div>
</div>

<script>
    var numOfElemPerRow = 10;
    var numOfRows = 5;
    var numOfElem = [];
    var images = ['3d_printer.svg', null, null, null, 'apple.svg', null, null, null, 'gears.svg', null, null, null,
        'internet.svg', null, null, null, 'robot.svg', null, null, null, 'tablet.svg', null, null, null, 'vr.svg',
        null, null, null
    ];

    if (window.matchMedia("(max-width: 1024px)").matches) {
        this.numOfElemPerRow = 7;
        this.numOfRows = 15;
    }

    if (window.matchMedia("(max-width: 640px)").matches) {
        this.numOfElemPerRow = 5;
        this.numOfRows = 15;
    }

    const numberOfElements = Math.ceil(window.innerWidth / (window.innerWidth / (this.numOfElemPerRow * 2 + 1)) * (this
        .numOfRows / 2));
    for (let i = 0; i < numberOfElements; i++) {
        this.numOfElem.push({
            imageName: this.images[Math.floor(Math.random() * this.images.length)]
        });
    }

    for (let i = 0; i < numOfElem.length; i++) {
        const element = numOfElem[i];
        var elem = document.createElement('div');
        elem.classList.add('item');
        elem.style.background = 'var(--color-' + Math.round(Math.random()) + ')';

        if (element.imageName != null) {
            var img = document.createElement('img');
            img.src = '../images/bg/' + element.imageName;
            elem.appendChild(img);
        } else {
            var nullContainer = document.createElement('div');
            nullContainer.classList.add('nullContainer');
            elem.appendChild(nullContainer);
        }

        document.querySelector('.innerContainer').appendChild(elem);
    }
</script>
