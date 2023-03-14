import { Component, OnInit } from '@angular/core';

@Component({
	selector: 'app-background',
	templateUrl: './background.component.html',
	styleUrls: ['./background.component.scss']
})

export class BackgroundComponent implements OnInit {
	public numOfElemPerRow: number = 10;
	public numOfRows: number = 5;
	public marginOfElem: number = window.innerWidth / this.numOfElemPerRow * 0.025;
	public numOfElem: Array<{ imageName: string | null }> = [];
	private images: Array<string | null> = ['3d_printer.svg', null, null, null, 'apple.svg', null, null, null, 'gears.svg', null, null, null, 'internet.svg', null, null, null, 'robot.svg', null, null, null, 'tablet.svg', null, null, null, 'vr.svg', null, null, null];

	constructor() { }

	ngOnInit(): void {
		if (window.matchMedia("(max-width: 1024px)").matches) {
			this.numOfElemPerRow = 7;
			this.numOfRows = 15;
		}

		if (window.matchMedia("(max-width: 640px)").matches) {
			this.numOfElemPerRow = 5;
			this.numOfRows = 15;
		}

		const numberOfElements = Math.ceil(window.innerWidth / (window.innerWidth / (this.numOfElemPerRow * 2 + 1)) * (this.numOfRows / 2));
		for (let i = 0; i < numberOfElements; i++) {
			this.numOfElem.push({ imageName: this.images[Math.floor(Math.random() * this.images.length)] });
		}
		// this.numOfElem = new Array(numberOfElements);



		setTimeout(() => {
			document.querySelectorAll('.item').forEach((elem) => {
				(elem as HTMLElement).style.background = 'var(--color-' + Math.round(Math.random()) + ')';
			});
		}, 0);
	}
}