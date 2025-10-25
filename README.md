# S-Admin - Sistema E-commerce per Arredamenti

## Panoramica del Progetto

**S-Admin** è un sistema di e-commerce completo sviluppato da **Arkosoft** (Stefano Basile e Danilo Ariano) per la gestione di cataloghi di prodotti di arredamento. Il sistema include un pannello di amministrazione avanzato (W-Admin) e un frontend responsive per la visualizzazione dei prodotti.

## Caratteristiche Principali

### 🛒 Funzionalità E-commerce
- **Catalogo Prodotti**: Gestione completa di prodotti con immagini, descrizioni e prezzi
- **Categorie e Sottocategorie**: Sistema gerarchico per organizzare i prodotti
- **Marche**: Gestione delle marche dei prodotti
- **Carrello della Spesa**: Sistema di acquisto completo
- **Preventivi**: Sistema per richieste di preventivi personalizzati
- **Ricerca Avanzata**: Funzionalità di ricerca per prodotti e categorie

### 🎨 Frontend
- **Design Responsive**: Interfaccia adattiva per desktop e mobile
- **Slider Banner**: Carosello per banner promozionali
- **Lightbox**: Visualizzazione immagini ingrandite
- **Menu Dinamico**: Navigazione intuitiva con categorie
- **SEO Friendly**: URL puliti e ottimizzati per i motori di ricerca

### ⚙️ Pannello di Amministrazione (W-Admin)
- **Dashboard**: Bacheca con statistiche e overview
- **Gestione Prodotti**: CRUD completo per prodotti
- **Gestione Categorie**: Amministrazione delle categorie
- **Gestione Marche**: Amministrazione delle marche
- **Gestione Utenti**: Sistema di autenticazione e autorizzazione
- **Gestione Preventivi**: Amministrazione richieste preventivi
- **Newsletter**: Sistema di invio newsletter
- **Banner Management**: Gestione banner promozionali
- **Immagini**: Upload e gestione immagini prodotti

## Architettura Tecnica

### Stack Tecnologico
- **Backend**: PHP (versione legacy con MySQL)
- **Database**: MySQL con engine MyISAM
- **Frontend**: HTML5, CSS3, JavaScript, jQuery
- **Librerie**: jQuery, Prototype, Scriptaculous
- **Editor**: TinyMCE per contenuti

### Struttura Database
Il sistema utilizza un database MySQL con le seguenti tabelle principali:
- `prodotti`: Catalogo prodotti
- `categorie`: Categorie e sottocategorie
- `marche`: Marche dei prodotti
- `utenti`: Utenti e amministratori
- `preventivi`: Richieste preventivi
- `banner`: Banner promozionali
- `avanzate`: Caratteristiche tecniche prodotti

### Compatibilità PHP
⚠️ **IMPORTANTE**: Il sistema utilizza funzioni MySQL deprecate (`mysql_*`) che sono state rimosse in PHP 7.0+. È compatibile con:
- **PHP 5.6** (ultima versione supportata)
- **MySQL 5.x**

## Struttura del Progetto

```
sadmin/
├── config.php                 # Configurazione database e sito
├── index.php                  # Entry point principale
├── head.php                   # Header HTML
├── controllo_header.php       # Controllo routing e 404
├── tema/                      # Frontend del sito
│   ├── css/                   # Fogli di stile
│   ├── js/                    # JavaScript
│   ├── immagini/              # Immagini del tema
│   ├── header.php             # Header del sito
│   ├── footer.php             # Footer del sito
│   ├── contenuto.php          # Homepage
│   ├── singoloprodotto.php    # Pagina prodotto
│   ├── carrello.php           # Carrello spesa
│   ├── preventivo.php         # Sistema preventivi
│   └── ...
├── w-admin/                   # Pannello amministrazione
│   ├── bacheca.php            # Dashboard principale
│   ├── gestioneprodotti.php   # Gestione prodotti
│   ├── gestionepreventivo.php # Gestione preventivi
│   ├── opzioni.php            # Impostazioni sistema
│   ├── functions.php          # Funzioni PHP
│   ├── css/                   # Stili admin
│   ├── js/                    # JavaScript admin
│   └── ...
├── installazione/             # Sistema di installazione
│   ├── database.php           # Schema database
│   ├── passo1.php             # Installazione step 1
│   ├── passo2.php             # Installazione step 2
│   └── ...
├── upload/                    # Upload immagini
├── banner/                    # Banner promozionali
└── tmpimmagini/               # Immagini temporanee
```

## Installazione

### Prerequisiti
- PHP 5.6 (non superiore)
- MySQL 5.x
- Server web (Apache/Nginx)
- Estensioni PHP: mysql, gd, session

### Procedura di Installazione
1. Caricare i file sul server web
2. **IMPORTANTE**: Copiare `config.example.php` in `config.php` e configurare le credenziali database
3. Impostare i permessi di scrittura per le cartelle:
   - `upload/` (0777)
   - `banner/` (0777)
   - `tmpimmagini/` (0777)
4. Accedere a `/installazione/passo1.php`
5. Seguire la procedura guidata di installazione
6. Configurare database e amministratore

### ⚠️ Sicurezza
- **NON** committare mai il file `config.php` con credenziali reali
- Utilizzare sempre `config.example.php` come template
- Cambiare tutte le password di default
- Utilizzare HTTPS in produzione

## Funzionalità Dettagliate

### Sistema Prodotti
- **Gestione Completa**: Nome, descrizione, prezzo, immagini
- **Categorie Multiple**: Assegnazione a più categorie
- **Caratteristiche Tecniche**: Legno, colore, dimensioni, finiture
- **Gestione Immagini**: Upload multiplo con ridimensionamento automatico
- **Prezzi e IVA**: Calcolo automatico prezzi con IVA

### Sistema Preventivi
- **Richiesta Preventivi**: Form per richieste personalizzate
- **Gestione Admin**: Visualizzazione e gestione richieste
- **Email Automatiche**: Notifiche per nuove richieste
- **Tracking**: Sistema di tracciamento richieste

### Sistema Utenti
- **Registrazione**: Form di registrazione utenti
- **Autenticazione**: Login/logout sicuro
- **Profili**: Gestione dati utente
- **Autorizzazioni**: Livelli di accesso (admin/utente)

### SEO e Performance
- **URL Puliti**: Sistema di URL SEO-friendly
- **Sitemap**: Generazione automatica sitemap.xml
- **Meta Tags**: Gestione meta tag per SEO
- **Paginazione**: Sistema di paginazione ottimizzato

## Sicurezza

### Misure Implementate
- **Validazione Input**: Sanitizzazione dati utente
- **Session Management**: Gestione sicura delle sessioni
- **SQL Injection**: Protezione tramite escape delle query
- **File Upload**: Controlli su tipi di file caricati

### Raccomandazioni
- Aggiornare a PHP 7+ con mysqli/PDO
- Implementare HTTPS
- Aggiornare librerie JavaScript
- Implementare CSRF protection

## Personalizzazione

### Tema Frontend
- Modificare file in `tema/css/style.css`
- Personalizzare `tema/header.php` e `tema/footer.php`
- Gestire immagini in `tema/immagini/`

### Configurazione
- Database: `config.php`
- Impostazioni: `w-admin/opzioni.php`
- Banner: `w-admin/gestionebanner.php`

## Limitazioni e Considerazioni

### Limitazioni Tecniche
- **PHP Legacy**: Utilizza funzioni deprecate
- **MySQL Deprecato**: mysql_* functions
- **Sicurezza**: Mancano alcune protezioni moderne
- **Performance**: Non ottimizzato per grandi volumi

### Raccomandazioni per Aggiornamento
1. **Migrazione Database**: Convertire a mysqli/PDO
2. **Aggiornamento PHP**: Migrare a PHP 7.4+
3. **Sicurezza**: Implementare protezioni moderne
4. **Performance**: Ottimizzare query e caching
5. **Responsive**: Migliorare design mobile

## Supporto e Manutenzione

### File di Log
- Errori PHP: Log del server web
- Database: Log MySQL
- Upload: Controllo permessi cartelle

### Backup
- **Database**: Export MySQL completo
- **File**: Backup completo cartella progetto
- **Immagini**: Backup cartella `upload/`

## Crediti

**Sviluppato da Arkosoft**
- **Stefano Basile**
- **Danilo Ariano**

**Software House Puglia** - Specializzata in soluzioni web e e-commerce

## Licenza

Proprietario: Arkosoft
Tutti i diritti riservati.

---

*Questo sistema rappresenta una soluzione completa per e-commerce di arredamenti, sviluppata con tecnologie dell'epoca. Per un utilizzo moderno, si raccomanda un aggiornamento completo dell'architettura tecnica.*
