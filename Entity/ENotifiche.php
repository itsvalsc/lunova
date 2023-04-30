<?php

/** La classe ENotifiche caratterizza la notifica generata da un cliente o un artista e che viene poi gestita dall'admin attraverso:
 * id: identificativo della notifica
 * testo: identifica il testo della notifica
 * priorità: identifica la priorità della notifica (i.e. alta se riguarda l'assistenza, bassa pr i commenti segnalati, e gli artisti iscrivono un loro disco ai sondaggi)
 * mittente: identifica l'id dell'utente che genera la notifica
 */

class ENotifiche{

    private string $id;
    private string $testo;
    private string $priorita;
    private string $mittente;

    public function __construct(string $t, string $pri, string $mit)
    {
        $this->id = "N" . random_int(0, 1000);
        $this->testo = $t;
        $this->priorita = $pri;
        $this->mittente = $mit;
    }

    /** metodi get */
    public function getId()
    { return($this->id); }

    public function getText()
    { return($this->testo); }

    public function getPriority()
    { return($this->priorita); }

    public function getMittente()
    { return($this->mittente); }

    /** metodi set */
    public function setId( string $idc ) : void
    { $this->id = $idc; }

    public function setPriority(string $p): void
    { $this->priorita = $p;}

    public function setText(string $t): void
    { $this->testo = $t; }

    public function setMittente(string $m): void
    { $this->mittente = $m; }
}
