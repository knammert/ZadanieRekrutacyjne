Do uruchomienia potrzeba:
- PHP w wersji 8.1.2
- Composer
- Node.js

Aby uruchomić projekt należy wejść do folderu projektu i w cli wykonać:
- composer install
- npm install
- php artisan migrate
- php artisan db:seed
- php artisan serve

Po wejściu na localhosta powinno przekierwoać do zadania.
Udało mi się zrealizować prawie wszystkie zadania oprócz testów, SCCS'a i wykonaniu we VueJS.

--- Kilka słów o bazie ---
- users 
- addresses - adresy użytkowników jak i dostaw
- shippings - opcje dostawy pobierane są z bazy
- payments - opcje płatności również pobierane są z bazy
- products
- carts -
- cart_items - produkty przypisywane do danego koszyka
- orders - 
- order_items - podobnie jak z koszykiem tylko, że dla zamówień
- discounts - rabaty uwzględniłem tylko w złotówkach.

Kody rabatowe:
ZAKUPY24 - nieaktwyny
SmartBees - aktywny




