import { Injectable } from '@angular/core';
import { ActivatedRouteSnapshot, CanActivate, Router, RouterStateSnapshot } from '@angular/router';
import { map, Observable, tap, of } from 'rxjs';
import { AuthService } from '../services/auth/auth.service';

@Injectable({
	providedIn: 'root'
})

export class AuthGuard implements CanActivate {

	constructor(private authService: AuthService, private router: Router) { }

	canActivate(): Observable<boolean> {
		console.log(this.checkPath('/user'));
		return this.authService.checkCredentials().pipe(
			map(userRole => {
				if (userRole) {
					switch (userRole?.role) {
						case 'User': {
							if (this.checkPath('/user')) return true;
							this.redirectTo('/unauthorized');
							return false
						}
						case 'Admin': {
							if (this.checkPath('/admin')) return true;
							this.redirectTo('/unauthorized');
							return false;
						}
						default: {
							this.redirectTo('/unauthorized');
							return false;
						}
					}
				} else {
					this.redirectTo('/login');
					return false
				}
			})
		);
	}

	checkPath(path: string) {
		if (location.pathname.startsWith(path)) {
			return true;
		} else {
			return false;
		}
	}

	redirectTo(path: string) {
		this.router.navigate([path]);
	}
}