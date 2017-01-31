# Changelog delle versioni di sviluppo di simple-chat #


## Versione 1 ##

### 1.0 ###

#### Alpha 1 ####
- Risolto un bug che impediva il refresh simultaneo della lista utenti online e della lista dei messaggi.
- Modificata la struttura html per rispettare le specifiche HTML5.
- Miglioramenti di programmazione.
- Modificato il titolo in "Chat 2G".
- Resi trasparenti i bordi bianchi delle emoticon (eccetto l'emoticon "piange").

#### Alpha 2 ####
- Aggiunta un'animazione che rende il testo inviato semitrasparente finché non è stato elaborato e aggiunto nella lista dei messaggi (Non compatibile con Internet Explorer).
- Cancellata la vecchia lista dei messaggi.
- Aggiunta data e ora raggruppate nei messaggi.
- Aggiunta la versione corrente accanto al titolo della chat.
- Prima release numerata e creato il changelog delle versioni.
- Aggiunta la formattazione guidata.

#### Alpha 3 ####
- Creata versione alternativa per Internet Explorer in HTML 4.01.
- Validata la versione in HTML5 tramite il W3C validator con esito positivo.
- Risolto un bug sulla formattazione guidata.
- Risolto un bug sul redirect automatico alla versione per Internet Explorer.

#### Beta 1 ####
- Resa beta accessibile agli utenti tramite conferma.
- Risolto un bug sull'accesso alla versione beta.
- La beta non include la versione per Internet Explorer.
- Modificata leggermente la grafica per il bottone di skip.
- Risolti bug minori di programmazione.

#### Beta 2 ####
- Migliorate prestazioni e velocità della chat.
- Risolto parzialmente il bug che causa il non corretto logout dalla lista utenti online.
- Aggiunto nel titolo visualizzato nel blog (prima-g.blogspot.com) relativo alla chat il numero di utenti online e il numero di messaggi non letti.
- Impostato un limite di 20 caratteri sulla lunghezza del nickname.
- Risolti bug minori.

#### Beta 3 ####
- Aggiunta la sintassi BBCode per la formatazione del testo.
- Modificato il processo per il rilevamento delle emoticon e risolti alcuni bug relativi.
- Risolto un bug sul raggruppamento di data e ora.
- Reso trasparente il bordo bianco dell'emoticon "piange".
- Aggiunta la data di ultima cancellazione dei contenuti.
- Corretto un bug che causava un errore sconosciuto.
- Migliorato il refresh dei messaggi che avviene solo se necessario.


## Versione 2 ##

### 2.0 ###

#### Alpha 1 ####
- Cambiato titolo in "Chat 3G".
- Cancellata la vecchia lista messaggi.
- Piccoli cambiamenti a livello di programmazione lato server.
- Creato file di configurazione personale dove settare tutte le impostazioni velocemente.

#### Alpha 2 ####
- Unite le versioni tra browser diversi (da testarne la compatibilità).
- Integrato il sistema di riconoscimento degli utenti online con scadenza sessioni, precedentemente sviluppato.
- Non è possibile effettuare l'accesso se un utente sta già usando il nickname scelto.
- Aggiunta l'opzione (implementato e funzionante) "memorizza il mio nickname" alla pagina di accesso.
- Aggiunta l'opzione (solo pulsante, non ancora implementato) "effettua il login automaticamente" alla pagina di accesso.
- Aggiunta la scheda "Impostazioni" dove poter cambiare il nickname (solo graficamente, funzione non implementata) e disattivare i suoni (funzione già implementata nelle versioni precedenti).

#### Alpha 3 ####
- Corretto bug relativo al controllo del nickname già in uso.
- Corretto un bug sulla funzione "memorizza il mio nickname".
- Corretto un bug sul caricamento della lista utenti online.
- Aggiunta la possibilità di cambiare il nickname (funzionante, prima era solo graficamente).
- Aggiunta la memorizzazione dell'impostazione "disattiva i suoni".

#### Beta 1 ####
- Corretto un bug con la formattazione guidata che interferiva con il rinnovamento della sessione.
- Aggiunta la formattazione guidata con finestre di dialogo personalizzate, [precedentemente sviluppate][1].
- Testati gli effetti sonori con i browser Safari, Chrome, Opera, Firefox e Internet Explorer. Con tutti funzionano, ma IE non supporta la funzione "disattiva suoni".

#### Beta 2 ####
- La beta è disponibile per Internet Explorer (corretti i bug che si verificavano con questo browser).
- Corretti dei bug con le finestre di dialogo personalizzate.
- Corretti alcuni bug con l'estrazione popup della chat sul blog.
- L'animazione dei messaggi inviati semitrasparenti finché non sono stati aggiunti alla lista messaggi è compatibile anche con Internet Explorer.
- Corretti bug minori.

#### Beta 3 ####
- Implementata la funzione "Effettua il login automaticamente".
- Corretti dei bug con l'estrazione popup della chat sul blog.
- Corretti bug minori.
- La funzione "Disattiva suoni" funziona con tutti i browser.
- I bug più prioritari sono stati risolti, la chat è pronta per essere rilasciata in versione stabile.


[1]: https://github.com/mttbernardini/dialog
