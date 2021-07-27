import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { HeaderComponent } from './header/header.component';
import { HomeComponent } from './home/home.component';
import { FooterComponent } from './footer/footer.component';
import { RestaurantComponent } from './restaurant/restaurant.component';
import { RecetteComponent } from './recette/recette.component';
import { MarketPlaceComponent } from './market-place/market-place.component';
import { AdminComponent } from './admin/admin.component';
import { ReclamationComponent } from './reclamation/reclamation.component';
import { CommandeComponent } from './commande/commande.component';
import { FactureComponent } from './facture/facture.component';
import { PanelAdminComponent } from './panel-admin/panel-admin.component';
import { ProduitComponent } from './produit/produit.component';

@NgModule({
  declarations: [
    AppComponent,
    HeaderComponent,
    HomeComponent,
    FooterComponent,
    RestaurantComponent,
    RecetteComponent,
    MarketPlaceComponent,
    AdminComponent,
    ReclamationComponent,
    CommandeComponent,
    FactureComponent,
    PanelAdminComponent,
    ProduitComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
