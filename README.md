# 📦 App_Gestiune - Platformă Gestiune Obiecte de Inventar

Această aplicație web a fost dezvoltată ca soluție tehnică pentru administrarea eficientă a inventarului și urmărirea echipamentelor dintr-o companie. Proiectul este construit pe un stack modern și robust, folosind **Laravel** și interfața de administrare **FilamentPHP**.

## 🚀 Caracteristici Principale

Aplicația îndeplinește cu succes toate cerințele funcționale ale temei de interviu, aducând și câteva îmbunătățiri de experiență a utilizatorului (UX):

* **Structură Ierarhică a Locațiilor:** Gestiune completă (CRUD) pentru **Sedii** și **Camere**. Camerele sunt alocate dinamic către sedii.
* **Gestiune Categorii:** Definirea tipurilor de echipamente (ex: Laptop, Imprimantă) alături de prefixele lor unice (ex: NB, PR).
* **Inventar Dispozitive:** Sistem complet de adăugare și editare a echipamentelor, cu detalii despre marcă, model, serie și utilizator alocat.
* **⚙️ Generare Automată a Numărului de Inventar:** Sistem inteligent care alocă un număr unic de forma `<PREFIX_FIRMA>-<PREFIX_CATEGORIE>-<NUMAR>`. Incrementarea (ex: 0001, 0002) se face automat și separat pentru fiecare categorie în parte.
* **🔄 Automatizare Status:** Statusul echipamentului se actualizează dinamic pe baza utilizatorului (ex: devine „Alocat” când este adăugat un utilizator și „Disponibil” când este scos).
* **🖨️ Etichete Termice cu Cod QR:** Generare de etichete pregătite pentru printare la dimensiuni fizice stricte (90x35mm / echivalent 70x234px). Fiecare etichetă include Numărul de Inventar, Iconița categoriei și un **Cod QR** care duce direct la pagina echipamentului.
* **📊 Dashboard & Filtre Avansate:** Panou principal cu statistici în timp real. Tabelul dispozitivelor include filtre complexe (ex: Căutare echipamente dintr-un anumit Sediu pe baza relației cu Camera).

---

## 💻 Cerințe de Sistem

* PHP ^8.2
* Composer
* MySQL / MariaDB (ex: XAMPP)
* Extensia PHP `ext-gd` activată (pentru generarea codurilor QR)

---

## 🛠️ Instalare și Configurare

Pentru a rula proiectul pe mașina locală, urmați acești pași:

**1. Clonarea proiectului**
```bash
git clone 
cd gestiune-inventar-laravel
```

**2. Instalarea dependențelor**
```bash
composer install
```

**3. Configurarea bazei de date**
* Copiați fișierul de configurare:
```bash
cp .env.example .env
```
* Generați cheia aplicației:
```bash
php artisan key:generate
```
* Deschideți fișierul `.env` creat și setați datele pentru baza de date (asigurați-vă că ați creat anterior o bază de date goală în MySQL):
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=numele_bazei_de_date_alese
DB_USERNAME=root
DB_PASSWORD=
```

**4. Rularea migrărilor**
Această comandă va crea toate tabelele necesare în baza de date:
```bash
php artisan migrate
```

---

## 🔐 Crearea unui Cont de Administrator

Deoarece aplicația folosește FilamentPHP pentru panoul de administrare, nu există un cont implicit. Pentru a vă putea loga, trebuie să creați un utilizator de admin rulând comanda:

```bash
php artisan make:filament-user
```
*(Sistemul vă va cere să introduceți un Nume, o adresă de Email și o Parolă).*

---

## 🚀 Rularea Aplicației

Porniți serverul local de dezvoltare:
```bash
php artisan serve
```

Aplicația este acum live! Pentru a accesa panoul de administrare, navigați în browser la adresa:
👉 **[http://127.0.0.1:8000/admin](http://127.0.0.1:8000/admin)**

---
*Proiect realizat ca temă tehnică de interviu.*
