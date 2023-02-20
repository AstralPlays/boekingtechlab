import { Injectable } from '@angular/core';
import { Observable, of, Subject } from 'rxjs';
import { HttpClient, HttpHeaders } from '@angular/common/http';

@Injectable({
  providedIn: 'root',
})
export class ApiService {
  baseApiUrl: string = 'http://localhost:8000/api';

  constructor(public http: HttpClient) {}

  public getTestData(): Observable<any> {
    return this.http.get<any>(this.baseApiUrl + '/Reservation/All');
  }
}
