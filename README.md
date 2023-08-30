# Projekt bloga

## Decyzje i założenia projektowe

### Dane początkowe
Aby mieć na czym pracować, powstała fabryka postów.

### Baza danych
Początkowo chciałem użyć SQLite jako bazy danych jednak decydując się na uruchomienie całości w kontenerach, w prosty sposób mogłem uruchomić bazę danych MySQL, nie wychodząc poza obszar projektu (serwer bazy danych etc).

W dotychczasowych projektach z reguły stosowałem PostreSQL jeśli miałem taką możliwość. Jeśli nie było takiej możliwości - najczęściej MariaDB lub MySQL.

W bardziej złożonych projektach projektowanie bazy danych rozbijam na dwa mniejsze etapy - migracje tworzone są dopiero po wykonaniu struktury bazy danych innym dedykowanym narzędziem. W tym przypadku uznałem to za przerost formy nad treścią.

### Role i Uprawnienia
Ponieważ w założeniach zdefiniowano stały podział ról i uprawnień, nie zdecydowałem się na wydzielanie poszczególnych uprawnień do bazy danych. W związku z tym nie widziałem potrzeby stosowania zewnętrznych bibliotek autoryzacyjnych takich jak spatie/laravel-permission (moja ulubiona bilbioteka autoryzacyjna).
Sprawdzanie dostępu oparłem o sprawdzenie roli użytkownika w systemie.

Kryteria projektowe dla systemu autoryzacyjnego są relatywnie proste. Uznałem, że wystarczającym rozwiązaniem będzie zdefiniowanie ról użytkowników używając typu wyliczeniowego (enum). Implementuje on interfejs RoleInterface

W projekcie komercyjnym role i uprawnienia z pewnością znalazłyby swoje miejsce w bazie danych, z uwzględnieniem relacji z użytkownikami. Jednak ponieważ role są z góry znane a użytkownicy mogą przynależeć tylko do jednej roli, wystarczającym rozwiązaniem jest to zaproponowane przeze mnie.

Dodatkowo ten zabieg ma na celu pokazanie mojego sposobu pracy, w którym staram się dopasowywać rozwiązania do potrzeb.

### Infrastruktura uruchomieniowa
Aby uruchomić wszystkie niezbędne usługi, zastosowałem konteneryzację oraz narzędzie Laravel Sail - dzięki niemu mogłem pominąć etap ręcznego budowania obrazów dockerowych. Starałem się zachować w miarę standardową konfigurację aby zapewnić prostotę uruchomienia. Jednocześnie używając Dockera na co dzień, chciałem pokazać jego zastosowanie, używając kontenerów definiowanych przez Laravel Sail:

* **Mailpit** - kontener z serwerm SMTP oraz interfejsem UI, aby móc wygodnie testować obsługę wiadomości e-mail.

* **Redis** - jest wymagany przez Horizona, w związku z czym kontener z serwerem Redisa także uwzględniłem w infrastrukturze.

* **Baza danych** - jako serwer bazy danych wykorzystałem kontener z bazą danych MariaDB.

### Interfejs użytkownika
Ponieważ zadanie nie ma na celu pokazania kompetencji graficznych / UX, Ograniczyłem się do minimum jeśli chodzi o sposób prezentacji danych. Na ile to było możliwe, wykorzystałem komponenty standardowo dostępne w Laravelu.
Z tej samej przyczyny wygląd wiadomości e-mail pozostał niezmieniony względem tego co dostarcza Laravel. Do obsługi CSS-a użyłem dostarczanego wraz z Laravelem frameworka Tailwind.

## Etapy prac
1. Opracowanie założeń projektowych, określenie kluczowych problemów a następnie sposobów ich rozwiązania.
2. Instalacja Laravela, kontenerów dodatkowych i zależności. Inicjalizacja repozytorium. Wstępna konfiguracja aplikacji.
3. Określenie i analiza wymaganej funkcjonalności.
4. Stworzenie struktury bazy danych (migracje)
5. Tworzenie kodu przy jednoczesnej weryfikacji założeń
6. Analiza powstałej logiki i refaktoring kodu


## Co chciałbym poprawić mając więcej czasu
- Obsługa plików graficznych mogłaby zostać rozbudowana o rodzaj pliku (galeria/miniaturka/zdjęcie główne). W ten sposób można pogrupować różne typy zdjęć / obrazków i obsługiwać je niezależnie.
- Można bardziej odseparować od siebie poszczególne elementy - kod mógłby być bardziej eventowy, jednak przy takiej skali truno było wymyśleć coś co mogłoby tak działać.
- Kilka testów na pewno by się przydało


W razie pytań piszcie śmiało.

