import { Component, Input, OnInit } from '@angular/core';
import { FormArray, FormControl, FormGroup, FormGroupDirective } from '@angular/forms';
import { faPlus, faMinus } from '@fortawesome/free-solid-svg-icons';
import Swiper, { Navigation, Pagination, SwiperOptions } from 'swiper';
Swiper.use([Navigation, Pagination]);

@Component({
	selector: 'app-slider',
	templateUrl: './slider.component.html',
	styleUrls: ['./slider.component.scss'],
})

export class SliderComponent implements OnInit {
	@Input() selectBox: boolean = false;
	@Input() controlName!: string;
	@Input() items!: Array<{ title: string, image: string }>;

	faPlusIcon = faPlus;
	faMinusIcon = faMinus;

	form!: FormGroup;

	private swiperParams: SwiperOptions = {
		slidesPerView: 'auto',
		spaceBetween: 10,
		// slidesOffsetBefore: 35,
		// slidesOffsetAfter: 35,
		// centeredSlides: true,
		navigation: {
			nextEl: '.swiper-button-next',
			prevEl: '.swiper-button-prev',
		},
		pagination: {
			el: ".swiper-pagination",
			enabled: true,
			dynamicBullets: true,
			clickable: true,
			renderBullet: function (index, className) {
				return '<span class="' + className + '">' + (index + 1) + '</span>';
			},
		},
	};

	constructor(private FGD: FormGroupDirective) { }

	ngOnInit(): void {
		const swiper = new Swiper('.swiper', this.swiperParams);
		this.form = this.FGD.form;
		this.form.addControl(this.controlName, new FormArray([]));
		this.populateArray();
	}

	get getControls(): FormArray {
		return this.form.get(this.controlName) as FormArray;
	}

	populateArray() {
		this.items.forEach(item => {
			this.getControls.push(new FormControl((this.selectBox ? false : 0), []));
		});
	}

	increaseValue(index: number) {
		this.getControls.controls[index].setValue(this.getControls.controls[index].value + 1);
	}

	decreaseValue(index: number) {
		if (this.getControls.controls[index].value > 0) {
			this.getControls.controls[index].setValue(this.getControls.controls[index].value - 1);
		}
	}
}