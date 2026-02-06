import { Component, OnInit, OnDestroy, signal } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { Router } from '@angular/router';
@Component({
  selector: 'app-home',
  imports: [FormsModule],
  templateUrl: './home.html',
  styleUrl: './home.css',
})
export class Home implements OnInit, OnDestroy {
  images = ['first.jpg', 'second.jpg', 'fird.jpg'];
  currentImageIndex = signal(0);
  private carouselInterval: any;
  searchFilters = {
    transactionType: 'acheter',
    propertyType: '',
    location: '',
    maxPrice: null as number | null
  };
  constructor(private router: Router) {}
  ngOnInit() {
    this.startCarousel();
  }
  ngOnDestroy() {
    this.stopCarousel();
  }
  startCarousel() {
    this.carouselInterval = setInterval(() => {
      this.nextSlide();
    }, 5000);
  }
  stopCarousel() {
    if (this.carouselInterval) {
      clearInterval(this.carouselInterval);
    }
  }
  nextSlide() {
    this.currentImageIndex.update(index =>
      (index + 1) % this.images.length
    );
  }
  goToSlide(index: number) {
    this.currentImageIndex.set(index);
    this.stopCarousel();
    this.startCarousel();
  }
  onSearch() {
    console.log('Recherche avec les filtres:', this.searchFilters);
  }
}
