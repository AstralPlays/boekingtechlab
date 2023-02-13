import { Component, OnInit } from '@angular/core';

@Component({
	selector: 'app-header',
	templateUrl: './header.component.html',
	styleUrls: ['./header.component.scss']
})
export class HeaderComponent implements OnInit {
	public menuOpen: boolean = false;

	constructor() { }

	ngOnInit(): void {
		var elements = document.querySelectorAll(".menu-nav-link");
		var max = 0;

		elements.forEach(element => {
			var width = element.clientWidth;
			if (width > max) max = width;
		});

		elements.forEach(element => {
			this.setWidth(element, max);
		});
	}

	private setWidth(element: any, w: number) {
		element.style.width = w + 'px';
	}

	toggleMenu() {
		if (!this.menuOpen) {
			document.querySelectorAll(".menu-nav")?.forEach(element => {
				element.classList.add("expanded");
			});

			this.menuOpen = true
		} else {
			document.querySelectorAll(".menu-nav")?.forEach(element => {
				element.classList.remove("expanded");
			});

			this.menuOpen = false
		}
	}

}
