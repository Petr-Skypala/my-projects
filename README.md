# my-projects

## Laravel projekt rozvrhy
- Aplikace na tvorbu rozvrhů pro terenní pečovatelky
- U každé pečovatelky sledujeme adresu, pracovní doby a návštěvy u lékařů
- V adresáři MySQL databáze je připravená databáze k importu
- Přihlašovací jméno: admin@example.com
- Heslo: test1234

## Nette projekt rozvrhy
- Stejné zadání jako v Laravel verzi
- Přihlašovací jméno: admin (test1234)
- Moduly Pečovatelky a Klienti
- U klientů sledujeme adresu a služby
- Služba je buď pevná, nebo plovoucí
- U pevné sledujeme den, čas od - do
- U plovoucí sledujeme dny, kdy může proběhnout, interval začátku od - do a délku
- Ke všem službám se přiřazují pečovatelky, které mohou docházet
- Připravené role: Pečovatelka, Koordinátorka, admin
- Nově vložená adresa vygeneruje kombinace známých adres pro získání času přejezdu
- Aplikace je spustitelná na webovém serveru Apache v OS Windows (XAMPP)

## Steamsales
- Aplikace zobrazuje probíhající nebo nejbližší plánovaný výprodej
- V admin části mohou přihlášení uživatelé vkládat nebo upravovat výprodeje
- Role admin umožňuje také vkládat a upravovat uživatele
- Přihlašovací jméno: admin (test1234)
- Hesla ostatních uživatelů jsou stejná
- Aplikace je spustitelná na webovém serveru Apache v OS Windows (XAMPP)
- Vyžaduje PHP 7.4 a Nette 3.x