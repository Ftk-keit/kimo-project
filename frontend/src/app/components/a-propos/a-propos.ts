import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';
@Component({
  selector: 'app-a-propos',
  imports: [CommonModule],
  templateUrl: './a-propos.html',
  styleUrl: './a-propos.css',
})
export class APropos {
  stats = [
    { number: '500+', label: 'Biens disponibles' },
    { number: '2000+', label: 'Clients satisfaits' },
    { number: '98%', label: 'Taux de satisfaction' },
  ];
  team = [
    {
      name: 'MARIAMA KAIRA DIALLO',
      role: 'Fondatrice & CEO',
      description: 'Visionnaire et leader, elle guide KIMO vers l\'excellence en redéfinissant les standards du marché immobilier guinéen.',
      image: '/assets/first.jpg',
    },
    {
      name: 'MARIAMA DIALLO',
      role: 'Co-fondatrice & Data Analyst',
      description: 'Experte en analyse de données, elle transforme les insights en stratégies concrètes pour optimiser l\'expérience utilisateur.',
      image: '/assets/second.jpg',
    },
  ];
  values = [
    {
      title: 'Transparence',
      description: 'Communication claire et honnête sur tous nos services et transactions',
    },
    {
      title: 'Innovation',
      description: 'Technologie de pointe pour simplifier et moderniser l\'immobilier',
    },
    {
      title: 'Excellence',
      description: 'Service de qualité premium et accompagnement personnalisé',
    },
    {
      title: 'Sécurité',
      description: 'Protection maximale de vos données et de vos transactions',
    },
  ];
}
