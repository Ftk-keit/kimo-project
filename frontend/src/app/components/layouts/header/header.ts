import { Component, signal } from '@angular/core';
import { RouterModule } from '@angular/router';
@Component({
  selector: 'app-header',
  imports: [RouterModule],
  templateUrl: './header.html',
  styleUrl: './header.css',
})
export class Header {
  isLoggedIn = signal(false);
  isDropdownOpen = signal(false);
  isMobileMenuOpen = signal(false);
  toggleDropdown() {
    this.isDropdownOpen.update(value => !value);
  }
  toggleMobileMenu() {
    this.isMobileMenuOpen.update(value => !value);
  }
  closeMobileMenu() {
    this.isMobileMenuOpen.set(false);
  }
}
