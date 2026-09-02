⚙️ Frontend Build – szpnew-wp-theme

Ten motyw WordPress wykorzystuje **Vite** do kompilacji kodu frontendu (SCSS + JS)  
z obsługą modularnego Bootstrapa 5.3. Dzięki temu build jest lekki, szybki i idealnie dopasowany do potrzeb projektu.

---

## 📁 Struktura projektu

szpnew-wp-theme/
│
├── src/
│ ├── js/
│ │ └── index.js # Główny plik JS (entry point)
│ └── scss/
│ ├── style.scss # Główny styl motywu
│ ├── bootstrap-custom.scss # Wybrane moduły Bootstrapa
│ └── theme/
│ ├── variables.scss
│ ├── typography.scss
│ └── global.scss
│
├── dist/ # Wygenerowane pliki produkcyjne
│ ├── assets/
│ │ ├── main-xxxx.css
│ │ └── main-xxxx.js
│ └── .vite/manifest.json # Mapa plików do ładowania w WordPressie
│
├── functions.php # Ładuje assety z manifestu
├── vite.config.js # Konfiguracja Vite
└── package.json


---

## 🧱 Budowanie projektu

### 🔨 Lokalny build
W katalogu motywu uruchom:

```bash
npm install
npm run build

Vite utworzy zoptymalizowaną wersję produkcyjną w katalogu /dist.
🧩 Import Bootstrapa

Projekt używa odchudzonego Bootstrapa – tylko wybranych części SCSS i JS.
📜 SCSS (src/scss/bootstrap-custom.scss)

// Wymagane core pliki
@import "bootstrap/scss/functions";
@import "bootstrap/scss/variables";
@import "bootstrap/scss/maps";
@import "bootstrap/scss/mixins";
@import "bootstrap/scss/utilities";

// Podstawowe style
@import "bootstrap/scss/root";
@import "bootstrap/scss/reboot";
@import "bootstrap/scss/type";
@import "bootstrap/scss/grid";
@import "bootstrap/scss/buttons";
@import "bootstrap/scss/forms";

// Komponenty używane w projekcie
@import "bootstrap/scss/dropdown";
@import "bootstrap/scss/navbar";
@import "bootstrap/scss/modal";
@import "bootstrap/scss/offcanvas";
@import "bootstrap/scss/helpers";
@import "bootstrap/scss/utilities/api";

💡 Można usunąć nieużywane moduły (np. modal, offcanvas, forms)
aby dodatkowo zmniejszyć wagę pliku CSS.
⚙️ JavaScript (src/js/index.js)

import "../scss/style.scss";

// Import tylko potrzebnych komponentów JS Bootstrapa
import 'bootstrap/js/dist/dropdown';
import 'bootstrap/js/dist/collapse';

// (opcjonalnie)
// import 'bootstrap/js/dist/modal';
// import 'bootstrap/js/dist/offcanvas';

🚀 Deployment na serwer

Cały proces buildowania i wysyłania motywu na serwer FTP jest automatyzowany przez GitHub Actions.
.github/workflows/deploy.yml

name: 🚀 Deploy szpnew theme to FTP

on:
  push:
    branches:
      - main

jobs:
  build-and-deploy:
    runs-on: ubuntu-latest

    steps:
      - name: 🧾 Checkout repo
        uses: actions/checkout@v4

      - name: ⚙️ Set up Node.js
        uses: actions/setup-node@v4
        with:
          node-version: 20

      - name: 📦 Install dependencies
        run: npm ci

      - name: 🏗️ Build project
        run: npm run build

      - name: 📤 Deploy to FTP
        uses: SamKirkland/FTP-Deploy-Action@v4.3.4
        with:
          server: biprotech.home.pl
          username: ${{ secrets.FTP_USERNAME }}
          password: ${{ secrets.FTP_PASSWORD }}
          protocol: ftp
          port: 21
          local-dir: ./
          server-dir: /wp-content/themes/szpnew-wp-theme/
          dangerous-clean-slate: true
          exclude: |
            **/node_modules/**
            **/.git/**
            **/.github/**
            **/src/**
            **/package*.json
            **/vite.config.js
            **/README.md
            **/.gitignore

      - name: 🧹 Clear WP Super Cache
        run: |
          echo "Clearing WP Super Cache..."
          curl -X GET "https://biprotech.com/wp-content/plugins/wp-super-cache/wp-cache-phase1.php?wp_delete_cache=true" || true

🧾 Efekt finalny builda

dist/.vite/manifest.json     → 0.18 kB
dist/assets/main.css         → ~50 kB (gzip: ~9 kB)
dist/assets/main.js          → ~44 kB (gzip: ~15 kB)

✅ Build gotowy w ok. 2–3 sekundy
✅ Pełna integracja z WordPressem
✅ Automatyczny deployment po git push na main
💡 Dodatkowe notatki

    Dołączone są tylko niezbędne moduły Bootstrapa → oszczędność ponad 200 KB.

    Cache na serwerze jest czyszczony automatycznie po każdym wdrożeniu.

    W przypadku zmiany nazwy motywu, zaktualizuj wartość themeName w pliku vite.config.js.

    📘 Projekt: szpnew-wp-theme
    Autor: Hubert
    Build system: Vite + Bootstrap 5.3 + GitHub Actions