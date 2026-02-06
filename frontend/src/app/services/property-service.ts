import { Injectable } from '@angular/core';
import {environment} from '../../environments/environment.development';
import {Observable} from 'rxjs';
import {Property} from '../entities/Property';
import {HttpClient} from '@angular/common/http';
@Injectable({
  providedIn: 'root',
})
export class PropertyService {
  apiUrl = environment.apiURL + '/properties';
  constructor(private http: HttpClient) {};
  getAllProperties() : Observable<Property[]>{
    return this.http.get<Property[]>(this.apiUrl);
  }
}
