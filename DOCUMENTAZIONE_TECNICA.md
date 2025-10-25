# Documentazione Tecnica - S-Admin E-commerce

## Analisi Tecnica Approfondita

### Informazioni Generali
- **Nome Progetto**: S-Admin
- **Tipo**: Sistema E-commerce per Arredamenti
- **Sviluppatore**: Arkosoft (Stefano Basile e Danilo Ariano)
- **Anno di Sviluppo**: Periodo 2010-2015 (stima basata su tecnologie utilizzate)
- **Versione PHP**: Compatibile con PHP 5.6 (utilizza funzioni mysql_* deprecate)

## Architettura del Sistema

### Stack Tecnologico Dettagliato

#### Backend
- **Linguaggio**: PHP 5.6 (legacy)
- **Database**: MySQL 5.x con engine MyISAM
- **Pattern**: Procedurale (non OOP)
- **Sessioni**: Gestione sessioni PHP nativa
- **Upload**: Sistema di upload file con validazione

#### Frontend
- **HTML**: HTML4/XHTML 1.0 Transitional
- **CSS**: CSS2/CSS3 con supporto cross-browser
- **JavaScript**: jQuery 1.11.3, Prototype, Scriptaculous
- **Librerie**: 
  - jQuery Carousel per slider
  - Lightbox per immagini
  - TinyMCE per editor WYSIWYG

#### Database Schema

```sql
-- Tabelle Principali
CREATE TABLE prodotti (
  id int(11) PRIMARY KEY AUTO_INCREMENT,
  nome varchar(255),
  descrizione text,
  prezzo decimal(10,2),
  idcategoria int(11),
  idmarca int(11),
  immagine varchar(255),
  data_inserimento datetime
);

CREATE TABLE categorie (
  id int(11) PRIMARY KEY AUTO_INCREMENT,
  nome varchar(255),
  appartenenza int(11) DEFAULT 0,
  descrizione text
);

CREATE TABLE marche (
  id int(11) PRIMARY KEY AUTO_INCREMENT,
  nome varchar(255),
  logo varchar(255),
  descrizione text
);

CREATE TABLE utenti (
  id int(11) PRIMARY KEY AUTO_INCREMENT,
  user varchar(50),
  psw varchar(50),
  email varchar(100),
  admin tinyint(1) DEFAULT 0,
  attivo tinyint(1) DEFAULT 1
);

CREATE TABLE preventivi (
  id int(11) PRIMARY KEY AUTO_INCREMENT,
  nome varchar(100),
  email varchar(100),
  telefono varchar(20),
  messaggio text,
  data_richiesta datetime,
  stato varchar(20) DEFAULT 'nuovo'
);
```

### Struttura File e Directory

#### Root Directory
```
sadmin/
├── config.php                    # Configurazione principale
├── index.php                     # Entry point
├── head.php                      # Header HTML
├── controllo_header.php          # Routing e 404
├── genera.php                   # Generazione sitemap
├── dbsitemap.php                # Database sitemap
├── robots.txt                   # SEO robots
├── sitemap.xml                  # Sitemap generata
```

#### Frontend (tema/)
```
tema/
├── css/
│   ├── style.css                # Stile principale
│   ├── jcarousel.basic.css      # Carousel
│   ├── lightbox.css             # Lightbox
│   └── jquery.fancybox-1.3.4.css
├── js/
│   ├── jquery-1.11.3.min.js     # jQuery
│   ├── jcarousel.basic.js       # Carousel
│   ├── lightbox.js              # Lightbox
│   └── main.js                  # Script principale
├── immagini/                     # Immagini tema
├── header.php                   # Header sito
├── footer.php                   # Footer sito
├── contenuto.php                # Homepage
├── singoloprodotto.php          # Pagina prodotto
├── carrello.php                 # Carrello
├── preventivo.php               # Sistema preventivi
├── ricerca.php                  # Ricerca prodotti
├── categorie.php                # Lista categorie
├── marche.php                   # Lista marche
└── ...
```

#### Backend (w-admin/)
```
w-admin/
├── index.php                    # Login admin
├── bacheca.php                  # Dashboard
├── functions.php                # Funzioni PHP
├── gestioneprodotti.php         # CRUD prodotti
├── gestionepreventivo.php       # Gestione preventivi
├── opzioni.php                  # Impostazioni
├── gestioneutente.php           # Gestione utenti
├── gestioneimmagini.php         # Gestione immagini
├── css/                         # Stili admin
├── js/                          # JavaScript admin
├── immagini/                     # Immagini admin
├── editor/                      # TinyMCE
└── inclusi/                     # File inclusi
```

## Funzionalità Tecniche Dettagliate

### Sistema di Routing
```php
// controllo_header.php
function controllo404($read) {
    $solourl = explode("?", $read);
    if(count($solourl) > 0) { 
        $read = $solourl[0];
    } 
    
    $newurl = explode("/", $read);
    $variabile = array($read, $newurl);
    
    // Gestione URL SEO-friendly
    switch($variabile) {
        case count($variabile[1]) == 3:
            $read = "pagina";
            break;
        // ... altri casi
    }
    return $read;
}
```

### Sistema di Autenticazione
```php
// w-admin/index.php
session_start();
$ris = mysql_query("select * from utenti where LOWER(user)='".strtolower(mysql_real_escape_string($_POST["user"]))."' and LOWER(psw)='".strtolower(mysql_real_escape_string($_POST["psw"]))."'");

if(strlen($idut) > 0) {
    $_SESSION['wadmin'] = "1";
    $_SESSION['utente'] = $idut;
    Header("Location: http://".$_SERVER['HTTP_HOST']."/w-admin/bacheca.php");
}
```

### Gestione Immagini
```php
// functions.php
function resize($src, $dst, $dstw, $dsth, $scala, $percorsosave) {
    $src = $percorsosave.$src;
    $dst = $percorsosave.$dst;
    list($width, $height, $type, $attr) = getimagesize($src);
    
    switch($type) {
        case 1: $im = imagecreatefromgif($src); break;
        case 2: $im = imagecreatefromjpeg($src); break;
        case 3: $im = imagecreatefrompng($src); break;
    }
    
    $tim = imagecreatetruecolor($dstw, $dsth);
    imagecopyresampled($tim, $im, 0, 0, 0, 0, $dstw, $dsth, $width, $height);
    ImageJPEG($tim, $dst, 90);
    imagedestroy($tim);
}
```

### Sistema di Paginazione
```php
// functions.php
function divisioneprodotti($corrente, $fine) {
    if($_SERVER['REQUEST_URI'] == "/") {
        $paginaurl = "/index.html";
    } else {
        $paginaurl = $_SERVER['REQUEST_URI'];
    }
    
    if(strlen($_SERVER['QUERY_STRING']) > 0) {
        $percorso = puliziapage("http://".$_SERVER['HTTP_HOST'].$paginaurl)."&";
    } else {
        $percorso = puliziapage("http://".$_SERVER['HTTP_HOST'].$paginaurl)."?";
    }
    
    // Logica paginazione...
}
```

## Configurazione Database

### File di Configurazione
```php
// config.php
<?php
//CONFIG
$host = "localhost";
$user = "admin_default";
$psw = "hn3FUBPXJM";
$database = "admin_default";

//METATAG
$abstarct = "";
$keywords = "";
$description = "";

//INFORMAZIONI PER PANNELLO
$titolosito = "Arreda";
$emailsito = "info@arkosoft.it";

//ANALYTICS
$codiceanalytics = "";
?>
```

### Connessione Database
```php
// Pattern utilizzato in tutto il sistema
$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione");
mysql_select_db($database) or die ("Non riesco a selezionare il database");
```

## Sistema di Installazione

### Procedura di Installazione
1. **Passo 1**: Configurazione database
2. **Passo 2**: Creazione tabelle
3. **Passo 3**: Configurazione sito
4. **Passo 4**: Creazione amministratore

### File di Installazione
```php
// installazione/installazionedb.php
// Creazione file config.php
$fp = fopen('../config.php', 'w+');
fputs($fp, '<?php'."\n");
fputs($fp, '$host='.chr(34).$_POST['hostdb'].chr(34).";\n");
// ... altre configurazioni

// Creazione database
$sql = explode(";", $contents);
for($i = 0; $i < $fine; $i++) {
    mysql_query($sql[$i].";") or die ("Creazione tabelle del DB fallita");
}

// Creazione amministratore
mysql_query("INSERT INTO `utenti` (`user`, `psw`, `email`, `admin`) VALUES ('".$_POST['nomeutente']."', '".$_POST['password']."', '".$_POST['emailsito']."', 1)");
```

## Sicurezza e Vulnerabilità

### Vulnerabilità Identificate
1. **SQL Injection**: Uso di `mysql_real_escape_string()` ma non sempre applicato
2. **XSS**: Mancanza di output encoding
3. **File Upload**: Controlli limitati sui file caricati
4. **Session Management**: Gestione sessioni basilare
5. **Password**: Password in chiaro nel database

### Raccomandazioni di Sicurezza
```php
// Esempio di miglioramento per SQL Injection
// VECCHIO (vulnerabile)
$query = "SELECT * FROM prodotti WHERE id = " . $_GET['id'];

// NUOVO (sicuro)
$id = intval($_GET['id']);
$query = "SELECT * FROM prodotti WHERE id = " . $id;
// Oppure con prepared statements
$stmt = $pdo->prepare("SELECT * FROM prodotti WHERE id = ?");
$stmt->execute([$id]);
```

## Performance e Ottimizzazione

### Problemi di Performance
1. **Query N+1**: Multiple query per caricare dati correlati
2. **Mancanza di Caching**: Nessun sistema di cache
3. **Immagini**: Nessuna ottimizzazione immagini
4. **Database**: Indici mancanti su alcune tabelle

### Ottimizzazioni Suggerite
```sql
-- Indici per migliorare performance
ALTER TABLE prodotti ADD INDEX idx_categoria (idcategoria);
ALTER TABLE prodotti ADD INDEX idx_marca (idmarca);
ALTER TABLE categorie ADD INDEX idx_appartenenza (appartenenza);
```

## Compatibilità e Limitazioni

### Compatibilità Browser
- **IE**: Internet Explorer 8+
- **Firefox**: 3.6+
- **Chrome**: 10+
- **Safari**: 5+

### Limitazioni PHP
- **PHP 7.0+**: Incompatibile (mysql_* functions rimosse)
- **PHP 5.6**: Ultima versione supportata
- **MySQL 8.0+**: Potenziali problemi con MyISAM

## Migrazione e Aggiornamento

### Piano di Migrazione
1. **Database**: Convertire da mysql_* a mysqli/PDO
2. **PHP**: Aggiornare a PHP 7.4+
3. **Sicurezza**: Implementare protezioni moderne
4. **Frontend**: Aggiornare librerie JavaScript
5. **Responsive**: Migliorare design mobile

### Esempio di Migrazione Database
```php
// VECCHIO (mysql_*)
$result = mysql_query("SELECT * FROM prodotti");
while($row = mysql_fetch_array($result)) {
    // ...
}

// NUOVO (mysqli)
$result = $mysqli->query("SELECT * FROM prodotti");
while($row = $result->fetch_array()) {
    // ...
}

// NUOVO (PDO)
$stmt = $pdo->query("SELECT * FROM prodotti");
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    // ...
}
```

## Monitoraggio e Debug

### Log e Debugging
```php
// Abilitare error reporting per debug
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Log personalizzato
function log_error($message) {
    $log_file = 'logs/error.log';
    $timestamp = date('Y-m-d H:i:s');
    file_put_contents($log_file, "[$timestamp] $message\n", FILE_APPEND);
}
```

### Metriche di Performance
- **Tempo di Caricamento**: Monitorare query lente
- **Utilizzo Memoria**: Controllare memory_limit
- **Upload**: Monitorare dimensioni file
- **Database**: Analizzare query con EXPLAIN

## Conclusioni Tecniche

### Punti di Forza
- **Completezza**: Sistema e-commerce completo
- **Funzionalità**: Gestione completa prodotti/preventivi
- **Usabilità**: Interfaccia admin intuitiva
- **SEO**: URL puliti e sitemap automatica

### Aree di Miglioramento
- **Sicurezza**: Implementare protezioni moderne
- **Performance**: Ottimizzare query e caching
- **Compatibilità**: Aggiornare stack tecnologico
- **Responsive**: Migliorare design mobile

### Raccomandazioni Finali
1. **Priorità Alta**: Migrazione database e aggiornamento PHP
2. **Priorità Media**: Implementazione sicurezza moderna
3. **Priorità Bassa**: Ottimizzazioni performance e UI/UX

---

*Documentazione tecnica completa del sistema S-Admin sviluppato da Arkosoft. Per supporto tecnico o aggiornamenti, contattare gli sviluppatori originali.*
