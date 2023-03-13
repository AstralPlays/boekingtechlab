import { AfterViewInit, Component, OnInit } from '@angular/core';
import { FormArray, FormBuilder, FormControl, FormGroup } from '@angular/forms';
import { Booking } from 'src/app/classes/booking/booking';

@Component({
	selector: 'app-reservation-page',
	templateUrl: './reservation-page.component.html',
	styleUrls: ['./reservation-page.component.scss']
})

export class ReservationPageComponent implements OnInit, AfterViewInit {
	public form!: FormGroup;
	public dateTable: Array<Date> = [];
	public timeTable: Array<string> = [];
	private sDate: Date = new Date(new Date().setDate(1));
	private eDate: Date = new Date(new Date().setDate(this.daysInMonth(undefined, undefined, this.sDate)));
	private selectedTimes: Array<string | null> = [];
	private selectedRooms: Array<string | null> = [];
	private selectedMats: Array<{ item: string, quantity: number } | null> = [];
	public rooms: Array<{ title: string, image: string }> = [{ title: 'Lokaal 1', image: 'logo.png' }, { title: 'Lokaal 2', image: 'logo.png' }, { title: 'Lokaal 3', image: 'logo.png' }, { title: 'Lokaal 4', image: 'logo.png' }, { title: 'Lokaal 5', image: 'logo.png' }, { title: 'Lokaal 6', image: 'logo.png' }, { title: 'Lokaal 7', image: 'logo.png' }, { title: 'Lokaal 8', image: 'logo.png' }, { title: 'Lokaal 9', image: 'logo.png' }, { title: 'Lokaal 10', image: 'logo.png' }]
	public mats: Array<{ title: string, image: string }> = [{ title: 'Materiaal 1', image: 'logo.png' }, { title: 'Materiaal 2', image: 'logo.png' }, { title: 'Materiaal 3', image: 'logo.png' }, { title: 'Materiaal 4', image: 'logo.png' }, { title: 'Materiaal 5', image: 'logo.png' }, { title: 'Materiaal 6', image: 'logo.png' }, { title: 'Materiaal 7', image: 'logo.png' }, { title: 'Materiaal 8', image: 'logo.png' }, { title: 'Materiaal 9', image: 'logo.png' }, { title: 'Materiaal 10', image: 'logo.png' }]

	constructor(private fb: FormBuilder) {
		this.createTimeTable('9:00', '17:00', 15);
		this.createDateTable(this.sDate, this.eDate);
	}

	ngOnInit(): void {
		this.form = this.fb.group({
			firstName: [''],
			lastName: [''],
			phone: [''],
			address: [''],
			month: [''],
			date: [''],
			times: this.fb.array([])
		});

		this.addCheckboxes();

		this.fillForm();
	}

	ngAfterViewInit(): void {
		this.onChanges();
	}

	daysInMonth(month?: number, year?: number, date?: Date): number {
		if (month && year) {
			return new Date(year, month, 0).getDate();
		} else if (date) {
			return new Date(date.getFullYear(), date.getMonth() + 1, 0).getDate();
		}
		return NaN;
	}

	fillForm() {
		this.form.patchValue({
			firstName: 'John',
			lastName: 'Doe',
			email: '',
			phone: '',
			address: '',
			month: new Date().toLocaleString([], { month: 'numeric' }), // 1 - 12 (January - December)
			times: [],
		});
	}

	changeMonth(event: Event) {
		const month: number = parseInt((event.target as HTMLInputElement).value) - 1;
		this.sDate = new Date(new Date(new Date().setMonth(month)).setDate(1)); // 0 - 11 (January - December)
		this.eDate = new Date(new Date(new Date().setMonth(month)).setDate(this.daysInMonth(undefined, undefined, this.sDate))); // 0 - 11 (January - December)
		this.createDateTable(this.sDate, this.eDate);
		// console.log(this.sDate);
		// console.log(this.daysInMonth(undefined, undefined, this.sDate));
		// console.log(this.eDate);
	}

	createDateTable(DateStart: Date, DateEnd: Date) {
		this.dateTable = [];
		let tmpDate: Date = DateStart
		while (tmpDate <= DateEnd) {
			let newDate = new Date(tmpDate);
			this.dateTable.push(newDate);
			tmpDate.setDate(tmpDate.getDate() + 1);
		}
	}

	createTimeTable(timeStart: string, timeEnd: string, intervalInMinuts: number) {
		this.timeTable = [];
		const startTime = new Date('01/01/2000 ' + timeStart);
		const endTime = new Date('01/01/2000 ' + timeEnd);
		while (startTime <= endTime) {
			const currentdate = new Date(startTime);
			this.timeTable.push(currentdate.toLocaleTimeString([], { hour12: false, hour: "2-digit", minute: "2-digit" }));
			startTime.setMinutes(startTime.getMinutes() + intervalInMinuts);
		}
	}

	onChanges(): void {
		this.form.valueChanges.subscribe(val => {
			this.selectedTimes = this.getTimes.getRawValue()
				.map((checked: any, i: number) => checked ? this.timeTable[i] : null)
				.filter((v: any) => v !== null);
			this.selectedRooms = this.getRooms.getRawValue()
				.map((checked: any, i: number) => checked ? this.rooms[i].title : null)
				.filter((v: any) => v !== null);
			this.selectedMats = this.getMats.getRawValue()
				.map((checked: any, i: number) => checked ? { item: this.mats[i].title, quantity: parseInt(this.getMats.controls[i].value) } : null)
				.filter((v: any) => v !== null);
		});
	}

	private addCheckboxes() {
		this.timeTable.forEach(() => this.getTimes.push(new FormControl(false)));
	}

	get getTimes(): FormArray {
		return this.form.get('times') as FormArray;
	}
	get getRooms(): FormArray {
		return this.form.get('rooms') as FormArray;
	}
	get getMats(): FormArray {
		return this.form.get('mats') as FormArray;
	}

	checkButtons() {
		setTimeout(() => {
			if (this.selectedTimes.length > 0) {
				for (let i = 0; i < this.getTimes.length; i++) {
					this.getTimes.at(i).disable();
				}

				for (let i = 0; i < this.getTimes.length; i++) {
					if (this.getTimes.at(i).value === true) {
						this.getTimes.at(i).enable();

						if (this.getTimes.at(i - 1) && i !== 0) {
							this.getTimes.at(i - 1).enable();
						}

						if (this.getTimes.at(i + 1) && i !== (this.getTimes.length - 1)) {
							this.getTimes.at(i + 1).enable();
						}
					}

					if (i !== 0 && this.getTimes.at(i - 1)?.value === true && this.getTimes.at(i + 1)?.value === true) {
						this.getTimes.at(i).setValue(true);
					}
				}
			} else {
				for (let i = 0; i < this.getTimes.length; i++) {
					this.getTimes.at(i).enable();
				}
			}
		}, 0);
	}

	submit() {
		console.log(this.form.getRawValue());
		console.log(this.selectedTimes);
		console.log(this.selectedRooms);
		console.log(this.selectedMats);
		console.log(new Booking({
			user: '0123456789',
			date: this.form.getRawValue().date,
			start_time: this.selectedTimes[0],
			end_time: this.selectedTimes[this.selectedTimes.length - 1],
			classroom: this.selectedRooms,
			materials: this.selectedMats,
		}));
	}
}