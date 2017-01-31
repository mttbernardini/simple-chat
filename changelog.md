# Changelog di simple-chat #


## Versioni precedenti alla 1 ##

- Creata la chat utilizzando come base [Micro Chat][1].
- Cambiato il titolo della chat in "Chat 1G".

- Aggiunti i suoni per quando arriva un messaggio e quando se ne spedisce uno.
- Risolto un bug che causava il malfunzionamento del login.

- Aggiunta una linea sotto la casella per inviare i messaggi nella quale vengono visualizzati il nickname e il pulsante per uscire.

- Aggiunta la possibilità di restare collegati anche dopo la chiusura del browser tramite memorizzazione dell'IP dell'utente.

- La possibilità di restare collegati non avviene più tramite memorizzazione dell'IP ma tramite creazione di un cookie sul browser dell'utente.
- Aggiunta la possibilità di cambiare il nickname.

- Risolto un bug che causava la possibilità di inviare messaggi vuoti.

- Creata la lista degli utenti online e aggiunti i suoni per quando un utente entra o esce.

- Aggiunte le emoticons e disabilitata momentaneamente la lista degli utenti online per numerosi bug.
- Aggiunta la possibilità di inserire link.

- Aggiunta la possibilità di formattare il testo e modificata la sintassi per l'inserimento dei link.

- Modificata la sintassi per l'inserimento dei link e riattivata la lista utenti online, nonostante i bug.
- Aggiunta la possibilità di disabilitare i suoni.

- Risolto un bug che causava lo scrolling verso il basso della lista dei messaggi durante il refresh della stessa.
- Aggiunto un pulsante a comparsa per arrivare a fine chat quando arriva un messaggio mentre si sta visualizzando un'altra zona della chat.

- Impostata offline la chat per numerosi bug.


## Versione 1 ##

### 1.0 ###

- Prima versione numerata.
- Creata versione compatibile con Internet Explorer in HTML4.01 e versione per altri browser in HTML5.
- Modificato il titolo in "Chat 2G".
- Risolto un bug che impediva il refresh simultaneo della lista utenti online e della lista dei messaggi.
- Il refresh delle liste avviene solo se necessario.
- Migliorate prestazioni e velocità della chat.
- Risolto parzialmente il bug che causa il non corretto logout dalla lista utenti online.
- Impostato un limite di 20 caratteri sulla lunghezza del nickname.
- Aggiunto nel titolo visualizzato nel blog (prima-g.blogspot.com) relativo alla chat il numero di utenti online e il numero di messaggi non letti.
- Cancellata la vecchia lista dei messaggi.
- Aggiunta data e ora raggruppate nei messaggi.
- Aggiunta un'animazione che rende il testo inviato semitrasparente finché non è stato elaborato e aggiunto nella lista dei messaggi (Non compatibile con Internet Explorer).
- Aggiunta la sintassi BBCode per la formatazione del testo.
- Aggiunta la formattazione guidata.
- Altri miglioramenti e risolti bug minori.

### 1.1 ###

- Codice riscritto, più pulito e veloce.
- Grafica rinnovata con colori più chiari e angoli arrotondati per i browser che li supportano
- Svuotata la lista dei messaggi.
- La lista dei messaggi si ricarica solo se necesssario, mentre la lista utenti online ogni 3 secondi.
- L'aggiornamento della lista messaggi e utenti avviene in due processi diversi.
- Unificato lo script javascript per altri browser e Internet Explorer (in futuro verranno unificate anche le versioni).
- Altri miglioramenti e risolti bug minori.


## Versione 2 ##

### 2.0 ###

- Cambiato titolo in "Chat 3G".
- Cancellata la vecchia lista messaggi.
- Creata un unica versione in HTML5 compatibile con tutti i browser.
- Integrato il sistema di riconoscimento degli utenti online con scadenza sessioni, precedentemente sviluppato.
- Non è possibile effettuare l'accesso se un utente sta già usando il nickname scelto.
- Aggiunta l'opzione "memorizza il mio nickname" alla pagina di accesso.
- Aggiunta l'opzione "effettua il login automaticamente" alla pagina di accesso.
- Aggiunta la scheda "Impostazioni" dove poter cambiare il nickname e disattivare i suoni.
- Aggiunta la memorizzazione dell'impostazione "disattiva i suoni".
- Aggiunta la formattazione guidata con finestre di dialogo personalizzate, [precedentemente sviluppate][2].
- Corretti dei bug con l'estrazione popup della chat sul blog.
- L'animazione dei messaggi inviati semitrasparenti finché non sono stati aggiunti alla lista messaggi è compatibile anche con Internet Explorer.
- Risolti altri bug minori e migliorate le prestazioni.

### 2.1 ###

- Risolto un problema con il riconoscimento e la codifica dei caratteri nei messaggi e nei nomi utente.
- Risolto un problema sul posizionamento del bottone di skip.
- Risolti bug minori.


## Versione 3 ##

### 3.0 ###

- L'archiviazione dei messaggi e della lista utenti online avviene in uno pseudo-database in XML.
- La comunicazione server-client avviene in JSON.
- La chat è ora completamente in XHTML 5. Il caricamento della pagina è più veloce e la compatibilità con i browser è maggiore.
- Grazie alle tre precedenti innovazioni sono presenti numerose nuove funzioni disponibili e la velocità e le prestazioni sono aumentate.
- La codifica di tutti i file correlati alla chat è ora UTF-8, ovvero Unicode (Internazionale), e non più ISO-8859-1 (Europa occidentale).
- Il raggruppamento di data e ora avviene in modo intelligente. I nuovi minuti vengono contati solo quando tra gli ultimi due messaggi sono trascorsi più di due minuti, oppure ogni 30 minuti.
- La chat è ora completamente multisessione. È possibile aprire più sessioni della chat contemporaneamente, le operazioni che si effettuano in una sessione (cambio di nome, uscita) vengono effettuate anche nell'altra. Il login deve essere tuttavia effettuato su tutte le sessioni aperte.
- Grafica migliorata: La data viene visualizzata a destra, il titolo è più grande, i bottoni hanno un aspetto 3D.
- In più messaggi scritti da un solo utente viene visualizzato il nickname solo nel primo messaggio che ha un'etichetta cronologica. Negli altri vengono visualizzati dei puntini (...).
- La lista dei messaggi riporta massimo 120 messaggi di quelli totali. Gli altri messaggi vengono archiviati per velocizzare la chat, ma non vengono cancellati. È possibile vedere la lista completa dei messaggi [qui][3].
- Se il browser non supporta le richieste AJAX, necessarie per il funzionamento della chat, non viene più mostrato un avviso chiudibile, ma la chat rimane inutilizzabile e il messaggio di AJAX non supportato è permanente e visualizzato sopra la chat, come l'avviso per JavaScript disabilitato.
- Il bottone di skip scompare automaticamente se si arriva a fine messaggi manualmente.
- Risolti bug minori.

### 3.1 ###

- Introdotto un sistema di logging degli eventi. Su un file verranno riportati i singoli login, logout e scritture degli utenti. Questa funzione è utile per poter individuare gli errori in caso di malfunzionamenti.
- Ottimizzata l'archiviazione e la protezione dei file.
- Cambiato titolo in "Chat 4G".
- Miglioramenti minori.



[1]: http://www.phptoys.com/product/micro-chat.html
[2]: https://github.com/mttbernardini/dialog
[3]: history.php
