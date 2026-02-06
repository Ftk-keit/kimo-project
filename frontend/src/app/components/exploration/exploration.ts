import {Component, OnInit, signal} from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import {PropertyService} from '../../services/property-service';
import {Property} from '../../entities/Property';
@Component({
  selector: 'app-exploration',
  imports: [CommonModule, FormsModule],
  templateUrl: './exploration.html',
  styleUrl: './exploration.css',
})
export class Exploration implements OnInit{
  properties1: Property[] = [];
  constructor( private propertyService: PropertyService) {
  }
  ngOnInit(): void {
    this.propertyService.getAllProperties().subscribe({
      next: (data: Property[]) => {
        this.properties1 = data;
        console.log(this.properties1);
      },
      error: (err) => {
        console.error('Erreur lors de la récupération des properties', err);
      }
    });
  }
  showAdvancedFilters = signal(false);
  currentPage = signal(1);
  itemsPerPage = 9;
  filters = {
    location: '',
    propertyType: 'tous',
    transactionType: 'tous',
    maxPrice: null,
    bedrooms: null,
    sortBy: 'recent',
  };
  propertyTypes = [
    { value: 'tous', label: 'Tous les types' },
    { value: 'appartement', label: 'Appartement' },
    { value: 'maison', label: 'Maison' },
    { value: 'bureau', label: 'Bureau' },
    { value: 'terrain', label: 'Terrain' },
  ];
  transactionTypes = [
    { value: 'tous', label: 'Location et Vente' },
    { value: 'location', label: 'Location' },
    { value: 'vente', label: 'Vente' },
  ];
  sortOptions = [
    { value: 'recent', label: 'Les plus récents' },
    { value: 'price-low', label: 'Prix: bas à haut' },
    { value: 'price-high', label: 'Prix: haut à bas' },
    { value: 'popular', label: 'Les plus populaires' },
  ];
  properties = [
    { id: 1, title: 'Appartement Kaloum', location: 'Kaloum, Conakry', price: '2.5M GNF/mois', image: '/assets/first.jpg', type: 'location', badge: 'Location', bedrooms: 3, bathrooms: 2, area: 120 },
    { id: 2, title: 'Villa Kipé', location: 'Kipé, Conakry', price: '850M GNF', image: '/assets/second.jpg', type: 'vente', badge: 'Vente', bedrooms: 5, bathrooms: 4, area: 350 },
    { id: 3, title: 'Maison Dubréka', location: 'Dubréka, Région', price: '320M GNF', image: '/assets/fird.jpg', type: 'vente', badge: 'Vente', bedrooms: 4, bathrooms: 3, area: 220 },
    { id: 4, title: 'Bureau Prestige', location: 'Plateau, Conakry', price: '1.2M GNF/mois', image: '/assets/first.jpg', type: 'location', badge: 'Location', bedrooms: 3, bathrooms: 2, area: 180 },
    ];
  get totalPages(): number {
    return Math.ceil(this.properties.length / this.itemsPerPage);
  }
  get paginatedProperties() {
    const startIndex = (this.currentPage() - 1) * this.itemsPerPage;
    const endIndex = startIndex + this.itemsPerPage;
    return this.properties.slice(startIndex, endIndex);
  }
  toggleAdvancedFilters() {
    this.showAdvancedFilters.update(value => !value);
  }
  goToPage(page: number) {
    if (page >= 1 && page <= this.totalPages) {
      this.currentPage.set(page);
      window.scrollTo({ top: 0, behavior: 'smooth' });
    }
  }
  onSearch() {
    console.log('Recherche avec filtres:', this.filters);
    this.currentPage.set(1);
  }
}
