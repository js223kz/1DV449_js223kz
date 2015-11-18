    #Reflektioner


    ##Finns det några etiska aspekter vid webbskrapning. Kan du hitta något rättsfall?
    De flesta rättsfall jag kan hitta verkar vara från USA och de flesta har gjorts upp i godo. Personligen
    tycker jag ena sekunden att det är en självklarhet att man ska kunna skrapa sidor i nästa tycker jag inte det.
    Om man ser till tillgången på data och tanken om att data ska vara tillgänglig och öppen i störst
    möjligaste mån för den allmänna nyttan så är det bra att man kan skrapa. De flesta företag/organistationer
    har inte möjlighet att skapa API:er för sin data. Å andra sidan finns det lagar om copyright, personlig
    integritet, sabotage av konkurrenters sidor som kan lättare kan ignoreras. Det vore lätt att tycka det är Ok att samla
    information från andras sidor om alla skrapare vore snälla och förnuftiga, men så är det inte ju inte.
    Bara för att det finns ett hål i säkerheten betyder inte att man har lov att utnyttja det.
    Jag är av åsikten att ju mer kunskap man har om webben och hur man ska gå tillväga för att samla
    information desto snällare måste man vara.

    Jag har funderat mycket på det här med prisjämförelsesajter som sammanställer priser från olika företag. Min första
    tanke var att det bara är positivt för de företag som är med på sidan, men vad leder det till om man drar det
    till sin spets. Pressade priser, mindre marginaler, färre anställda, mer produktion i fattiga länder,
    mindre produktion här hemma?

    Webben är en gigantisk stor gråzon som på galet kort tid har gjort om hela vårt samhälle. Undrar om inte Tim
    Berners Lee ibland undrar om han släppt löst ett monster.


    ##Finns det några riktlinjer för utvecklare att tänka på om man vill vara "en god skrapare" mot serverägarna?
    Man bör i största möjligaste mån följa riktlinjerna i robots.txt.
    Man bör stänga connection så fort man fått sitt svar.
    Man ska vara uppmärksam på filtyper och filstorlek så man inte hämtar hem gigantiska filer.
    Man ska visa vem man är och ange kontaktuppgift gärna i form av en emailadress.
    Man ska skriva effektiv kod och inte köra långa komplicerade skript som riskerar att lagga sidan man skrapar.
    Man bör ge upphovskällan cred.
    Man ska inte stjäla businness från sidan man skrapar.
    Man ska inte kränka enskilda personers integritet.
    Man ska undvika att skrapa url:er man vet kan vara känsliga som /admin därtill ingår också /update /delete osv.

    ##Begränsningar i din lösning- vad är generellt och vad är inte generellt i din kod?
    Jag har försökt att där det är möjligt inte begränsa antalet som ska skrapas. T ex kan det finnas hur många personer
    helst i gruppen, hur många filmer som  helst osv. Jag har strukturerat min appklikation på ett sådant sätt
    att det ska bli lättare att lägga till sidor att skrapa eller ändra om det behövs. Men det är ju helt klart så att
    om man skrapar en sida så blir koden väldigt oflexibel och skör och på flera ställen har jag fått anpassa
    söksträngarna bara för att t ex Söndag skrivs som Söndag på en sida, Sunday på en andra och so på en tredje.
    Jag har också tänkt på att försöka hitta minsta gemensamma nämnare för de element jag vill åt för att göra min kod
    mindre rörig och lättare att underhålla om något skulle ändras.

    ##Vad kan robots.txt spela för roll?
    Egentligen ingen eftersom det inte finns någon lag som säger att skapare av robotar måste följa reglerna i robots.txt.
    Men om det nu skulle vara snälla robotskapare så kan man i robots.txt ange vilka sidor eller kataloger man inte
    vill ska skrapas. Det kan vara för att minska belastning på servern eller undvika att inaktuella sidor och kataloger
    kommer med i skrapresultatet. Man kan också ange andra regler man önskar ska följas om man skrapar sidan.




















# weekend-booking-web-site
This is not a real web site its just for an assignment where students writes a web agent scraping three diffrent sites

## Install
Make sure you have the following installed on your system:
* Virtual Box [https://www.virtualbox.org/](https://www.virtualbox.org/)
* Vagrant [https://www.vagrantup.com/](https://www.vagrantup.com/)

Now, do:

1. Pull (`git clone https://github.com:thajo/weekend-booking-web-site.git`) into your directory. 

2. Start the virtual machine using `vagrant up` (May take 5 - 10 minutes this first time. Ignore red command line statements and warnings.)

3. SSH into the machine using  `vagrant ssh`

4. Change directory to `cd /vagrant`

5. Install depencies for the node application `npm install` 

6. start the application running `node app`

## Daily workflow
1. Start out by `vagrant up` your machine and ssh into it (`vagrant ssh`). Change directory to `cd /vagrant`.

2. start the application running `node app`

3. Open up a browser on your local machine and visit the url `http://localhost:8080`

4. Let your web agent consume that base-url and start writing your code.

5. When you are done simply `ctrl+c` in the vagrant-terminal to stop the server, `exit` to  exit the ssh-session and do a `vagrant halt` to stop the machine or `vagrant suspend` to only suspend it.

6. Don´t forget to do lots of commits and push your code to the repo shared with the user "1DV449"
