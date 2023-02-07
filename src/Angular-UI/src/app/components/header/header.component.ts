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

		// document.querySelector(document).addEventListener("click", "li.dropdown-control > a", function (event) {
		// 	event.preventDefault()
		// 	fieldName = document.querySelector(this).attr("data-dropdown");
		// 	if (document.querySelector("ul[name=" + fieldName + "]").classList.contains("show")) {
		// 		document.querySelector("ul[name=" + fieldName + "]").classList.remove("show");
		// 		document.querySelector("i[name=" + fieldName + "]").classList.remove("fa-chevron-up").classList.add("fa-chevron-down");
		// 	} else {
		// 		if (document.querySelector("ul.dd-menu.show").length >= 1) {
		// 			document.querySelector("ul.dd-menu.show").classList.remove("show");
		// 			document.querySelector("i#arrow").classList.remove("fa-chevron-up").classList.add("fa-chevron-down");
		// 		}
		// 		document.querySelector("ul[name=" + fieldName + "]").classList.add("show");
		// 		document.querySelector("i[name=" + fieldName + "]").classList.remove("fa-chevron-down").classList.add("fa-chevron-up");
		// 	}
		// });

	}

	toggleMenu() {
		if (!this.menuOpen) {
			document.querySelectorAll(".menuburger, nav, .menu-nav, .menu-nav-item")?.forEach(element => {
				element.classList.add("open");
			});

			this.menuOpen = true
		} else {
			document.querySelectorAll(".menuburger, nav, .menu-nav, .menu-nav-item")?.forEach(element => {
				element.classList.remove("open");
			});

			if (document.querySelector("ul.dd-menu")?.classList.contains("show")) {
				document.querySelector("ul.dd-menu")?.classList.remove("show");
				document.querySelector("i#arrow")?.classList.remove("fa-chevron-up");
				document.querySelector("i#arrow")?.classList.add("fa-chevron-down");
			}

			this.menuOpen = false
		}
	}

}
