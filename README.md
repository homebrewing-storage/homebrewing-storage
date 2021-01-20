# Homebrewing-storage - Magazyn surowców do warzenia piwa

Aplikacja umożliwiająca użytkownikowi na zapisywanie swoich surowców do warzenia piwa, dzięki czemu użytkownik w przejrzysty sposób będzie mógł widzieć stan posiadanego magazynu. Każdy z surowców posiada swój rodzaj oraz datę przydatności. Powiadomienia będą zaś informować użytkownika o kończącym się terminie przydatności surowców.

### Autorzy:
*   Dawid Rudnik *(Lider/PM/Dev-ops/Backend)*
*   Krystian Duda *(Backend)*
*   Adrian Książek *(Frontend)*
*   Łukasz Kichman *(Tester)*

### Funkcjonalności:
*   Panel główny użytkownika:
    *   Panel składników,
    *   Panel powiadomień,
    *   Panel edycji użytkownika,
    *   Logi,
*   System powiadomień,
*   System logowania i rejestracji (również przez social media),
*   System Logów,
*   CRUD składników,

## Stack technologiczny:
*   PHP
*   Laravel 8
*   MySQL
*   React

## Uruchomienie aplikacji w środowisku deweloperskim
**1. Pobranie projektu z repozytorium**
```
git clone -b master https://github.com/homebrewing-storage/homebrewing-storage.git
```
```
cd homebrewing-storage
```

**2. Konfiguracja pliku .env**
```
cp .env.example .env
```

**3. Tworzenie i uruchamianie kontenerów**
```
docker-compose up -d --build
```

**4. Pobieranie zależności**
```
docker-compose exec php-fpm composer install
```

**5. Wygenerowanie kluczy**
```
docker-compose exec php-fpm php artisan key:generate
```

**6. Migracja tabel w bazie danych**
```
docker-compose exec php-fpm php artisan migrate 
```

**Aplikacja powinna być dostępna na:**
```
http://localhost
```

**Laravel Telescope powinien być dostępny na:**
```
http://localhost/telescope
```

## Polecenia deweloperskie
**Uruchomianie polecenia w kontenerze PHP (polecenie `*`)**
```
docker-compose exec php-fpm *
```
**Na przykład**
```
docker-compose exec php-fpm php artisan migrate 
docker-compose exec php-fpm php artisan make:controller 
docker-compose exec php-fpm php artisan make:model Model -mc 
```

**Uruchomienie kontenerów**
```
docker-compose up -d
```

**Wyświetlenie uruchomionych kontenerów**
```
docker ps
```

**Zatrzymanie kontenerów bez ich usuwania**
```
docker-compose stop
```

**Zatrzymanie i usunięcie kontenerów**
```
docker-compose down
```
