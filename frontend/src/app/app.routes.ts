import { Routes } from '@angular/router';
import { Home } from './components/home/home';
import { Exploration } from './components/exploration/exploration';
import { APropos } from './components/a-propos/a-propos';
import { OurServices } from './components/our-services/our-services';
import { BlogActu } from './components/blog-actu/blog-actu';
import { Contact } from './components/contact/contact';
export const routes: Routes = [
  {
    path: '',
    component: Home,
    title: 'Home'
  },
  {
    path: 'explorer',
    component: Exploration,
    title: 'Explorer les biens'
  },
  {
    path: 'a-propos',
    component: APropos,
    title: 'À propos de KIMO'
  },
  {
    path: 'nos-services',
    component: OurServices,
    title: 'Nos Services'
  },
  {
    path: 'blog-actualite',
    component: BlogActu,
    title: 'Blog & Actualités'
  },
  {
    path: 'contact',
    component: Contact,
    title: 'Contact'
  },
];
