import { Component, OnInit } from '@angular/core';
import { FormGroup, FormControl, FormBuilder, Validators } from '@angular/forms';
import { faGoogle } from '@fortawesome/free-brands-svg-icons';
import { faLock, faUser } from '@fortawesome/free-solid-svg-icons';
import { Subject, takeUntil } from 'rxjs';
import { ApiService } from 'src/app/services/api.service';

@Component({
	selector: 'app-register-page',
	templateUrl: './register-page.component.html',
	styleUrls: ['./register-page.component.scss']
})
export class RegisterPageComponent implements OnInit {
	google = faGoogle;
	user = faUser
	lock = faLock
	registerForm!: FormGroup
	unsubscribe$ = new Subject<void>();

	constructor(private fb: FormBuilder, private Api: ApiService) { }

	ngOnInit(): void {
		this.registerForm = this.fb.group({
			email: new FormControl('', [Validators.required, Validators.email]),
			password: new FormControl('', [Validators.required, Validators.pattern(/(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@$!%*#?&^_-]).{8,}/)])
		});
	}

	onSubmit() {
		if (this.registerForm.valid) {
			this.Api.postRegister(this.registerForm.value)
				.pipe(takeUntil(this.unsubscribe$))
				.subscribe((data: { user_id: number, api_token: string }) => {
					console.log(data);
					document.cookie = "id=" + data.user_id
					document.cookie = "token=" + data.api_token
				})
		}
		else {
			alert('form not valid')
		}
	}
}
