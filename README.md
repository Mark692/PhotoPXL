# PhotoPXL
SCOPO DELL'APPLICAZIONE:

L'applicazione che si vuole realizzare è volta alla raccolta di foto personali, con la possibilità di raggrupparle per album, e visualizzare i contenuti caricati da altri utenti.


ATTORI:

Utente Non Loggato:	
- visualizzata una schermata iniziale con possibilità di registrazione

Utente Registrato Standard: 	
- visualizza una schermata home composta da miniature di foto
- può accedere al profilo personale
- può modificare i dettagli del profilo
- può aggiungere/modificare dettagli di foto e album
- limite caricamento foto a 10 upload al giorno
- le foto sono caricate con visibilità pubblica
- può commentare e lasciare "mi piace"

Utente Registrato PRO:	      
- stessi privilegi dell'Utente Registrato Standard
- può impostare una visibilità Privata alle foto
- nessun limite di caricamento giornaliero

Moderatore:	
- stessi privilegi dell'Utente Registrato PRO
- potere di bannare utenti

ADMIN:    
- stessi priviliegi del Moderatore
- potere di upgrade/downgrade utenti

Utente Bannato:     
- visualizza stessa schermata dell'Utente Non Loggato senza possibilità di login


SPECIFICHE E CASI D'USO:

La schermata iniziale è composta da una piccola descrizione del sito e il form di registrazione e di login.
Una volta loggato, l'utente vede la Home con miniature di foto, di default le foto più popolari (numero di "like"); da qui si può effettuare una ricerca secondo vari parametri, ad esempio: categorie preferite, data di caricamento, ecc.
L'utente registrato può accede al proprio profilo da cui può visualizzare le foto già caricate e caricarne altre, modificarne i dettagli, diventare Utente PRO nel caso sia Standard, modificare l'immagine del profilo.
Al momento dell'upload può scegliere se creare un nuovo album o caricare foto singole.
Le foto sono definite da un Titolo, una Descrizione, Data di upload, una Visibilità (privata o pubblica), Categorie, il nome dell'utente da cui sono state caricate ed un eventuale album di appartenenza; mentre l'abum è definito da Titolo, Descrizione, Categorie e Utente.
Gli utenti possono commentare e lasciare un "mi piace" alle foto.
