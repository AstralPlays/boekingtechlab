import { ComponentFixture, TestBed } from '@angular/core/testing';

import { SocialMediaBarComponent } from './social-media-bar.component';

describe('SocialMediaBarComponent', () => {
  let component: SocialMediaBarComponent;
  let fixture: ComponentFixture<SocialMediaBarComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ SocialMediaBarComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(SocialMediaBarComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
