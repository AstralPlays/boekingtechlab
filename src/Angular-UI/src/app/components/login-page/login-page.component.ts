import { Component, OnInit } from '@angular/core';
import { FormGroup, FormControl, FormBuilder, Validators } from '@angular/forms';
import { faGoogle } from '@fortawesome/free-brands-svg-icons';
import { faLock, faUser } from '@fortawesome/free-solid-svg-icons';

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

	constructor(private fb: FormBuilder) { }

	ngOnInit(): void {
		this.loginForm = this.fb.group({
			email: new FormControl('', [Validators.required, Validators.email]),
			password: new FormControl('', [Validators.required])
		});
	}

	onSubmit() {
		console.log(this.loginForm.value);
	}

	loginWithGoogle() {
		console.log('Login with Google');
	}
}
