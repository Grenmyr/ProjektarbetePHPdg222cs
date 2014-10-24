### Projektgenomgång

```
Mitt mål med applikationen var att få kunskap i den andra kursen medans jag läste php. Genom nicha mig mot yuml
som vi hade arbetat med i workshop 1 OoAoD kursen.

Därför nichade jag mitt projekt mot att försöka skapa "psudo" kod med yuml syntax. Pseudo blev ju längre projektet gick
riktigt php syntax. Och det är högre än vad jag vågade hoppas på innan start. Det var även stimulerande att få försöka efterlikna objektstrukturer
med klasser variabler funktioner och relationer.
```

###### Nya Kunskaper
Förutom lära mig MVC´, hur php fungerar som språk och dess syntax.
Så fick jag tidigt lägga stor möde på få ihop ett regex som kan tolka yuml syntax. Detta uttryck var väldigt
svårt och långt med mina då extremt begränsade kunskaper. Med mycket arbete och läst på så har jag faktiskt tillslut förstått
regex syntax och kan läsa dom.

Andra saker som var väldigt stimulerande var MVC särskilt hur man med hur man kan fixa
paging med en navigationsvy, en Mastercontroller som hanterar controllerna och en MasterView som hanterar vyerna.
Det var väldigt skönt när jag fick ihop det på de 3 respektive klasserna och deras relationer i slutet på projektet.

Att bygga upp en modell som representerade min inmatade yuml syntax var extremt kul också, att ha arrayer med variabler/funktioner
som medlemmar till en klass var inte bara en bra lösning kodmässigt. Det känns även som man fick efterlikna språkstruktur genom kodrepresnetering.

Att få publisera på ett eget webbhotell är klockrent det också och ger bra insyn i hur det verkligen fungerar.

Att få använda PHPFactory som en sorts php tolkning som både GuestView(och Memberview som ärver GuestView) samt SaveToZipView
använder var kul. Då de får php syntax av den. Som de sedan bäddar in i två olika versioner, där GuestView lägger dom runt. Och
SaveToZipView skapar körbara phpfiler.

###### Problem
```
Jag hade väldigt lång tid att förstå hur jag skulle använda pagineringen och minska strängberoenden. Även skriva
de reguljära uttrycken för tolka yuml syntax var extremt hög svårighetsgrad.

Förstå hur jag skulle bygga upp strukturen för tolka yuml syntax rent klassmässigt var också utmanande.

I vyerna var det bara Min SavetoZipView som var svårt, då jag var tvungen att skapa filer, zippa och skapa redirect för download.

Under projektets tid har jag också fått refaktorera extremt mycket. Särksilt eftersom jag valde att lyfta in laboration 2 och 4 gav det mig
väldigt mycket jobb. Jag tror i efterhand det hade varit smartare att bara skriva om dom, särskilt koden från laboration 2
hade mycket konstiga lösningar.
```
