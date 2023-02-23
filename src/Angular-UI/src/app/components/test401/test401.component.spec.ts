import { ComponentFixture, TestBed } from '@angular/core/testing';

import { Test401Component } from './test401.component';

describe('Test401Component', () => {
  let component: Test401Component;
  let fixture: ComponentFixture<Test401Component>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ Test401Component ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(Test401Component);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
