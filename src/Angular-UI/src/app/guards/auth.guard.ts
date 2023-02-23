import { Injectable } from '@angular/core';
import { ActivatedRouteSnapshot, CanActivate, Router, RouterStateSnapshot } from '@angular/router';
import { map, Observable, Subject, takeUntil, tap } from 'rxjs';
import { Auth } from '../classes/auth/auth';
import { AuthService } from '../services/auth/auth.service';



@Injectable({
	providedIn: 'root'
})
export class AuthGuard implements CanActivate {
	constructor(private authService: AuthService, private router: Router) { }

	canActivate(): Observable<boolean> {
		return this.authService.checkCredentials().pipe(
			tap((userRole:Auth | null) => {
				if (userRole?.role === null) {
					// Handle error case
					this.router.navigate(['/unauthorized']);
				} else if (userRole?.role === 'User') {
					// Allow access to user page
				} else if (userRole?.role === 'Admin') {
					// Allow access to admin page
				} else {
					// Handle unknown role case
					this.router.navigate(['/unauthorized']);
				}
			}),
			map(userRole => userRole !== null) // convert result to boolean
		);
	}
}
