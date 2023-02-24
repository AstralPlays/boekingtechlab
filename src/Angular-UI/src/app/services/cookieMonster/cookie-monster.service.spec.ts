import { TestBed } from '@angular/core/testing';

import { CookieMonsterService } from './cookie-monster.service';

describe('CookieMonsterService', () => {
  let service: CookieMonsterService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(CookieMonsterService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
