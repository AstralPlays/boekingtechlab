import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { catchError, Observable, of } from 'rxjs';
import { Auth } from 'src/app/classes/auth/auth';

@Injectable({
	providedIn: 'root'
})

export class AuthService {
	baseApiUrl: string = 'http://localhost:8000/api';

	constructor(private http: HttpClient) { }

	checkCredentials(): Observable<Auth | null> {
		return this.http.post<Auth>(this.baseApiUrl + '/auth', {user_id: parseInt(this.getCookie('id'))}, {headers : {'Authorization': `Bearer ${this.getCookie('token')}`}} ).pipe(
			catchError(() => of(null)) // handle error case
		);
	}
	
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