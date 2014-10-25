### ProjektGenomgång

Mitt mål med applikationen var att få kunskap i OoAoD den andra kursen medans jag läste php.
Därav valde jag att arbeta med en app som tolkar yuml syntax och skapar kodexempel.

Det har varit stimulerande att få försöka efterlikna objektstrukturer
med klasser variabler funktioner och relationer.


###### Nya Kunskaper
Förutom lära mig MVC, hur php fungerar som språk och dess syntax.
Så fick jag tidigt lägga stor fokus på få ihop ett regex som kan tolka yuml syntax. Detta uttryck var väldigt
svårt och långt med mina då extremt begränsade kunskaper. Med mycket arbete och läst på så har jag  förstått
regex syntax och kan läsa dom och skriva.

Andra saker som var väldigt stimulerande var MVC särskilt hur man kan fixa
paging med en NavView,sen en Mastercontroller som hanterar controllerna och en MasterView som hanterar ordningen vyerna ritas.


Att bygga upp en modell som representerade min inmatade yuml syntax var extremt kul också, att ha arrayer med variabler/funktioner
som medlemmar till en klass som "ägde" dom var inte bara en bra lösning kodmässigt. Det känns även som man fick efterlikna språkstruktur genom kodrepsemetering.

Att få publisera på ett eget webbhotell är klockrent det också och ger bra insyn i hur det verkligen fungerar.

###### Problem

Det tog väldigt lång tid att förstå hur jag skulle använda pagineringen och minska strängberoenden.
Även skriva reguljära uttryck för tolka yuml syntax var extremt hög svårighetsgrad.

I vyerna var det bara Min SavetoZipView som var svårt, då jag var tvungen att skapa filer,
zippa och skapa redirect för download.

Under projektets tid har jag också fått refaktorera extremt mycket.
Särksilt eftersom jag valde att lyfta in laboration 2 och 4 gav det mig
väldigt mycket jobb. Jag tror i efterhand det hade varit smartare att bara skriva om dom,
särskilt koden från laboration 2 hade mycket konstiga lösningar.

###### Testning
Att skriva testfall la jag kanske ner för mycket krut på, samtidigt så har jag hittat flera buggar tack vare dom.
Jag hoppas att om det finns buggar i mitt projekt att testerna i allafall visar att jag försökt testa och hitta fel.

###### Vad som stinker i min kod
Min UmlToCodeController är ganska lång, och särskilt funktionen showMemberView() är för lång.
Jag hade om jag fått refaktorera gått loss på den klassen.

Jag vet ni inte gillar exceptions, men jag tog bort alla meddelanden från mina custom exceptions. Och istället bara
fångar jag undantagen i kontrollerna och kallar bara på funktioner i vyn som skriver egna meddelanden. Förutom enstaka
gånger då jag skickar med som nån sträng i nått exception som representerar User eller namn.

Min prodjectsView stinker inte bara i stavning, utan ganska äcklig generering av lista. Men den validerar i HTML och
jag ger mig inte på att refaktorera den nu.

Det tvåriktade beroendet mellan NAvView och MasterView, men jag valde medvetet att skapa det istället för MasterView
skulle ha ett dolt strängberoende. Därför blev istället NavView beroende till 2 publika variabler i MasterView.

###### Vad som är bra
Symbiosen MasterController/Navview/MasterView för hålla ihop trådarna. Ger bra grund för bygga på min app.

Min InterpretModel/ClassModel/FuncModel/VariableModel för mig svår kod, och snyggt med hur CLassModel äger
sina variabler och funktioner var kul att få skriva i kod. InterPretModel blir ett mellanlager mellan vyerna
och de klassrepresenterande klasserna.


###### OM ... jag haft mer tid....
*Hade jag skrivit mer i modellen och implementerat argument
*fler tolkningar av associationer/dependencys
*Kanske typer och kod för fler språk


#######David Grenmyr