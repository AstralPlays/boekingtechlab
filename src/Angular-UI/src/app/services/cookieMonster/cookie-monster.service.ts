import { Injectable } from '@angular/core';

@Injectable({
	providedIn: 'root'
})
export class CookieMonsterService {

	constructor() { }

	getCookie(cName: string): string {
		const name = cName + "=";
		const cDecoded = decodeURIComponent(document.cookie);
		const cArr = cDecoded.split('; ');
		let res: string = '';
		cArr.forEach(val => {
			if (val.indexOf(name) === 0) res = val.substring(name.length);
		})
		return res
	}
}
