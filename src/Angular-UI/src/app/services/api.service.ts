import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { HttpClient } from '@angular/common/http';
import { Login } from '../classes/login/login';

@Injectable({
	providedIn: 'root',
})

export class ApiService {
	baseApiUrl: string = 'http://localhost:8000/api';

	constructor(public http: HttpClient) { }

	public getTestData(): Observable<any> {
		return this.http.get<any>(this.baseApiUrl + '/reservation/all');
	}

	public postRegister(data: Login): Observable<{ user_id: number, api_token: string }> {
		return this.http.post<{ user_id: number, api_token: string }>(this.baseApiUrl + '/user/register', data);
	}

	public postLogin(data: Login): Observable<{ user_id: number, api_token: string }> {
		return this.http.post<{ user_id: number, api_token: string }>(this.baseApiUrl + '/user/login', data)
	}
}
