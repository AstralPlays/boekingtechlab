import { Component, OnInit } from '@angular/core';
import { FormGroup, FormControl, FormBuilder, Validators } from '@angular/forms';
import { faGoogle } from '@fortawesome/free-brands-svg-icons';
import { faLock, faUser } from '@fortawesome/free-solid-svg-icons';
import { Subject, takeUntil } from 'rxjs';
import { ApiService } from 'src/app/services/api.service';

@Component({
	selector: 'app-login-page',
	templateUrl: './login-page.component.html',
	styleUrls: ['./login-page.component.scss']
})

export class LoginPageComponent implements OnInit {
	google = faGoogle;
	user = faUser
	lock = faLock
	loginForm!: FormGroup
	unsubscribe$ = new Subject<void>();

	constructor(private fb: FormBuilder, private Api: ApiService) { }

	ngOnInit(): void {
		this.loginForm = this.fb.group({
			email: new FormControl('', [Validators.required, Validators.email]),
			password: new FormControl('', [Validators.required, ])
		});

		// this.Api.postRegister(this.loginForm.value)
		// 	.pipe(takeUntil(this.unsubscribe$))
		// 	.subscribe({
		// 		next: (chuck: any) => { console.log(chuck); },
		// 		error: (error) => { console.log(error); }
		// 	});
	}

	onSubmit() {
		if (this.loginForm.valid) {
			this.Api.postLogin(this.loginForm.value)
				.pipe(takeUntil(this.unsubscribe$))
				.subscribe((data: { user_id: number, api_token: string }) => {
					console.log(data);
					document.cookie = "id=" + data.user_id
					document.cookie = "token=" + data.api_token
				})
		} else {
			alert('Form not valid')
		}
	}

	loginWithGoogle() {
		console.log('Login with Google');
	}
}
