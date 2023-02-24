import { Component, OnInit } from '@angular/core';
import { CookieMonsterService } from 'src/app/services/cookieMonster/cookie-monster.service';

@Component({
	selector: 'app-header',
	templateUrl: './header.component.html',
	styleUrls: ['./header.component.scss']
})
export class HeaderComponent implements OnInit {
	public menuOpen: boolean = false;
	public isLogged: boolean = false;

	constructor(private cookieMonster: CookieMonsterService) { }

	ngOnInit(): void {
		if (this.cookieMonster.getCookie("token") && this.cookieMonster.getCookie("id")) {
			this.isLogged = true;
		} else {
			this.isLogged = false;
		}

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
