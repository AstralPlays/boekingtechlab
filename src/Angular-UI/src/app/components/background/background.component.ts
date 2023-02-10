import { Component, OnInit } from '@angular/core';

@Component({
	selector: 'app-background',
	templateUrl: './background.component.html',
	styleUrls: ['./background.component.scss']
})

export class BackgroundComponent implements OnInit {
	public numOfRows: number = 20;
	public numOfElemPerRow: number = 20;
	public marginOfElem: number = window.innerWidth / this.numOfElemPerRow * 0.025;
	public numOfElem?: Array<null>;

	constructor() { }

	ngOnInit(): void {
		if (window.matchMedia("(max-width: 1024px)").matches) {
			this.numOfElemPerRow = 10;
			this.numOfRows = 15;
		}

		if (window.matchMedia("(max-width: 640px)").matches) {
			this.numOfElemPerRow = 5;
			this.numOfRows = 15;
		}

		const numberOfElements = Math.ceil(window.innerWidth / (window.innerWidth / (this.numOfElemPerRow * 2 + 1)) * (this.numOfRows / 2));
		this.numOfElem = new Array(numberOfElements);

		setTimeout(() => {
			document.querySelectorAll('.item').forEach((elem) => {
				(elem as HTMLElement).style.background = 'var(--color-' + Math.round(Math.random()) + ')';
			});
		}, 0);
	}
}