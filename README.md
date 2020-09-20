## Magazines Laravel API
Prosta aplikacja w wykorzystaniu laravel api do logowania użytkowników którzy mogą wyświetlać dane o wydawcach oraz magazynach.
## Inicjalizacja projektu
Pobieramy kod lokalnie na swój komputer:

    https://github.com/ThePatrykOOO/magazinesapi.git
Przechodzimy do katalogu projektu:

    cd magazinesapi
Instalujemy zależności laravela:

    composer install
Kopiujemy plik konfiguracyjny:

    cp .env.example .env
Generujemy klucz aplikacji:

    php artisan key:generate

Ustalamy odpowiednie dane do logowania bazy danych:

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=laravel
    DB_USERNAME=root
    DB_PASSWORD=

Wykonujemy migrację:

    php artisan migrate
Wykonujemy seedery na bazie danych:

    php artisan db:seed

Generujemy token JWT:

    php artisan jwt:secret


## ENDPOINTY
**LOGOWANIE**
POST */api/authorize*
Body:

    {
		"email": "admin",
		"password": "admin"
	}
Należy pamiętać, aby pobrany *access_token* dołączać w requeście przy poniższych endpointach.

**Pobranie listy wydawnictw**
GET: */api/publishers/list*

**Wyszukanie magazynu**
GET */api/magazines/search*
Opcjonalne parametry:

 - *publisher_id* -  id wydawcy
 - *magazine_name* - nazwa magazynu
 - *page* - aktualna strona
 - *per_page* - ilość rekordów na stronie

**Zwrócenie pojedynczego magazynu**
GET */api/magazines/{magazineId}*

Wymagane parametry:

 - *magazineId* -  id konkretnego magazynu


## Testy jednostkowe
Aby uruchomić testy jednostkowe w projekcie należy uruchomić komendę:

    php artisan test
