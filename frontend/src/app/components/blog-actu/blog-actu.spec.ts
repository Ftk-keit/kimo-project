import { ComponentFixture, TestBed } from '@angular/core/testing';
import { BlogActu } from './blog-actu';
describe('BlogActu', () => {
  let component: BlogActu;
  let fixture: ComponentFixture<BlogActu>;
  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [BlogActu]
    })
    .compileComponents();
    fixture = TestBed.createComponent(BlogActu);
    component = fixture.componentInstance;
    await fixture.whenStable();
  });
  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
