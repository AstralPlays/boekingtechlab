import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { catchError, Observable, of } from 'rxjs';
import { Auth } from 'src/app/classes/auth/auth';
import { CookieMonsterService } from '../cookieMonster/cookie-monster.service';

@Injectable({
	providedIn: 'root'
})

export class AuthService {
	baseApiUrl: string = 'http://localhost:8000/api';

	constructor(private http: HttpClient, private cookieMonster: CookieMonsterService) { }

	checkCredentials(): Observable<Auth | null> {
		return this.http.post<Auth>(this.baseApiUrl + '/auth', { user_id: parseInt(this.cookieMonster.getCookie('id')) }, { headers: { 'Authorization': `Bearer ${this.cookieMonster.getCookie('token')}` } }).pipe(
			catchError(() => of(null)) // handle error case
		);
	}
}