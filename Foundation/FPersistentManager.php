<?php

/**
 * La classe FPersistentManager viene utilizzata come interfaccia tra le classi Foundation e i Controller
 * @package Foundation
 */

class FPersistentManager{

    private static $instance;

    /**
     * Metodo che instanzia un unico oggetto di questa classe richiamando il costruttore se non è stato già istanziato un oggetto
     * @return FPersistentManager
     */
	public static function getInstance() {
		if(!isset(self::$instance)){
			self::$instance = new FPersistentManager();
		}
		return self::$instance;
	}


    /** METODI GENERICI */

    /**
     * Metodo che richiama la exist della classe foundation tra i parametri
     * @param string $Fclass
     * @param string $key1 la chiave primaria dell'oggetto
     * @param string $key2 eventuale seconda chiave
     * @return bool
     */
    public function exist(string $Fclass, $key1, $key2=null) : bool {
        $ris = $Fclass::exist($key1,$key2);
        return $ris;
    }

    /**
     * Metodo che richiama la exist_username della classe foundation tra i parametri
     * @param string $Fclass
     * @param string $key1
     * @return bool
     */
    public function exist_username(string $Fclass, $key1) : bool {
        $ris = $Fclass::exist_username($key1);
        return $ris;
    }

    /**
     * Metodo che richiama la exist_id della classe foundation tra i parametri
     * @param string $Fclass
     * @param string $key1
     * @return bool
     */
    public function exist_id(string $Fclass, $key1) : bool {
        $ris = $Fclass::exist_id($key1);
        return $ris;
    }

    /**
     * Metodo che richiama la load della classe foundation tra i parametri
     * @param $Fclass
     * @param $key1 la chiave primaria dell'oggetto
     * @return mixed
     */
    public function load(string $Fclass, $key1) {
        $object = $Fclass::load($key1);
        return $object;
    }

    /**
     * Metodo che permette di salvare un oggetto sul db tramite i parametri
     * @param $obj
     * @param null $mailutente
     */
    public function store(object $obj,$mailutente=null)  {
        $Eclass = get_class($obj);
        $Fclass = str_replace("E", "F", $Eclass);
        $ris = $Fclass::store($obj,$mailutente);
    }

    /**
     * Metodo che richiama la delete della classe foundation tra i parametri
     * @param string $Fclass
     * @param string $key1
     * @param string $key2
     * @param string $key3
     * @return mixed
     */
    public function delete(string $Fclass, $key1, $key2=null, $key3=null) {
        $ris = $Fclass::delete($key1,$key2,$key3);
        return $ris;
    }

    /**
     * Metodo che richiama la deletebyUtente della classe foundation tra i parametri
     * @param string $Fclass
     * @param string $key1
     * @return mixed
     */
    public function deletebyUtente(string $Fclass, $key1) {
        $ris = $Fclass::deletebyUtente($key1);
        return $ris;
    }

    /**
     * Metodo che richiama la update della classe foundation
     * @param object $obj
     * @return bool
     */
    public function update(object $obj) : bool {
        $Eclass = get_class($obj);
        $Fclass = str_replace("E", "F", $Eclass);
        $ris = $Fclass::update($obj);
        return $ris;
    }

    /**
     * Metodo che permette l'aggiornamento del valore di un campo passato per parametro
     * @param string $class
     * @param string $attributo
     * @param string $newvalue
     * @param string $key
     * @return bool
     */
    public function update_value(string $class, string $attributo, string $newvalue,string $key) {
        return $class::update_value($attributo, $newvalue, $key);
    }


    /** METODI DI EUTENTE  */

    /**
     * Metodo che permette di criptare la password quando un utente si registra per la prima volta
     * richiama la criptaPassword di EUtente
     * @param $password
     */
    public static function criptaPassword($password): string {
        return EUtente::criptaPassword($password);
    }


    /** METODI DI FADMIN  */

    /**
     * Metodo che permette di riprendere i dischi filtrati per genere
     * richiama la loadgeneri in FAdmin
     */
    public function prelevaGeneri(){
        $gen = FAdmin::loadgeneri();
        return $gen;
    }


    /** METODI DI FARTISTA  */

    /**
     * Metodo che richiama la loadArtisti
     */
    public function prelevaArtisti(){
        $artisti = FArtista::loadArtisti();
        return $artisti;
    }

    /**
     * Metodo che richiama la loadArtistiperUsername
     */
    public function prelevaArtistiperUsername($username):?array{
        $artisti = FArtista::loadArtistiperUsername($username);
        return $artisti;
    }

    /**
     *  Metodo che permette di trovare il nome di un artista passando l'id
     * @param $id
     */
    public function FindArtistName($id){
        return FArtista::loadName($id);
    }

    /**
     *  Metodo che permette di trovare l'id di un artista passando lo username
     * @param $username
     */
    public function FindArtistId($username){
        return FArtista::loadId($username);
    }

    /**
     *  Metodo che permette di prelevare l'istanza di un artista passando l'id
     * @param $id
     */
    public function ArtistaFromID($id){
        return FArtista::loadFromID($id);
    }

    /**
     *  Metodo che permette di eliminare l'istanza di un artista passando la mail
     * @param $mail
     */
    public function EliminaAccontA($mail){
        return FArtista::delete($mail);
    }


    /** METODI DI FCLIENTE  */

    /**
     * Metodo che preleva tutti i clienti
     * @param $username
     */
    public function prelevaClienti(){
        $clienti = FCliente::loadClienti();
        return $clienti;
    }

    /**
     * Metodo che preleva i clienti tramite username
     * @param $username
     */
    public function prelevaClientiperUsername($username){
        $artisti = FCliente::loadClientiperUsername($username);
        return $artisti;
    }

    /**
     * Metodo che preleva il cliente tramite id
     * @param $username
     */
    public function ClienteFromID($id){
        return FCliente::loadId($id);
    }

    /**
     * Metodo che richiama il metodo Assistenza in FCliente
     * @param $t
     * @param $id
     */
    public function AssistenzaMex($t,$id){
        return FCliente::Assistenzaa($t,$id);
    }

    /**
     *  Metodo che permette di eliminare l'istanza di un cliente passando la mail
     * @param $mail
     */
    public function EliminaAccontC($mail){
        return FCliente::delete($mail);
    }

    /**
     *  Metodo che permette di aggiornare lo stato di un cliente
     * @param string $mail
     * @param $value
     */
    public function update_bannato(string $email, $value) {
        return FCliente::updateBannato($email, $value);
    }



    /** METODI DI FDISCO */

    /**
     * Metodo che richiama prelevaDischi da FDisco
     */
	public function prelevaDischi() : array {
        return FDisco::prelevaDischi();
	}

    /**
     * Metodo che richiama prelevaDischiperGenere da FDisco
     */
    public function prelevaDischiperGen($genere):array {
        return FDisco::prelevaDischiperGenere($genere);
    }

    /**
     * Metodo che richiama prelevaDischiperTitolo
     * @param $aut
     */
    public function prelevaDischiperTitolo($titolo):array{
        return FDisco::prelevaDischiperTitolo($titolo);
    }

    /**
     * Metodo che preleva dischi tramite il nome dell'artista
     * @param $aut
     */
    public function prelevaDischiperAutore($aut){
        $id = $this->FindArtistId($aut);
        if ($id!=null){
            return FDisco::prelevaDischiperAutore($id);
        }
        return array();
    }

    /**
     * Metodo che preleva dischi tramite l'id dell'artista
     * @param $aut
     */
    public function prelevaDischiperIDAutore($aut){
        return FDisco::prelevaDischiperAutore($aut);
    }

    /**
     * Metodo che permette di aggiornare la quantità di un disco
     * @param $id
     * @param $numero
     */
    public function SetQta($id, $numero ): void {
        $modifica = FDisco::updateQta($numero, $id);
    }

    /**
     * Metodo che permette di aggiornare il prezzo di un disco
     * @param $id
     * @param $numero
     */
    public function SetPrice($id, $numero ): void {
        $modifica = FDisco::updatePrice($numero, $id);
    }

    /** METODI DI FCOMMENTO */

    /**
     * Metodo che richiama la loadCommenti di FCommento
     */
    public function loadCommenti($disco){
        return FCommento::loadCommenti($disco);
    }

    /**
     * Metodo che richiama la loadCommentibyCliente di FCommento
     */
    public function loadCommentibyCliente($cl){
        return FCommento::loadCommentibyCliente($cl);
    }


    /** METODI DI FVOTAZIONE */

    public function loadmpCommenti($cl,$dc){
        return FVotazioneCommento::loadMP($cl,$dc);
    }

    public function loadNumeroMP($dc){
        return FVotazioneCommento::loadNumeroMP($dc);
    }
    public function loadNumeroMPbyComm($comm){
        return FVotazioneCommento::loadNumeroMPbyComm($comm);
    }

    public function loadVotazioniDiscoperCliente($id){
        return FVotazioneDisco::loadperCliente($id);
    }


    /** METODI DI FSONDAGGIO */

    /**
     * Metodo che permette di prelevare dal db il sondaggio in corso
     */
    public function prelevaSondaggioInCorso(){
        return FSondaggio::load_incorso();
    }

    /**
     * Metodo che permette la votazione di uno dei 3 dischi del sondaggio in corso
     * @param $disco
     * @param $utente
     */
    public function vota($disco,$utente){
        try {
            $sondaggio = FSondaggio::load_incorso();
            $id = $sondaggio->getId();
            $sondaggio->aggiungi_voto($disco);
            FSondaggio::update($sondaggio);
            FSondaggio::store_votazione($utente,$id,$disco);
            return true;
        } catch (Exception $ex){
            return false;
        }
    }

    /**
     * Metodo che permette la creazione di un nuovo sondaggio eliminando i dischi del sondaggio precedente
     * @param ESondaggio $sondaggio
     */
    public function crea_sondaggio(ESondaggio $sondaggio){
        FSondaggio::store($sondaggio);
        FRichiesta::delete($sondaggio->getDisco1()->getID());
        FRichiesta::delete($sondaggio->getDisco2()->getID());
        FRichiesta::delete($sondaggio->getDisco3()->getID());
    }


    /** METODI DI FRICHIESTA */
    public function prelevaRichieste(){
        $richieste = FRichiesta::load_richieste();
        return $richieste;
    }


    /** METODI DI FNOTIFICHE */


    public function prelNotifAlte(){
        $not = FNotifiche::loadAlta();
        return $not;
    }

    public function prelNotifBasse(){
        $not = FNotifiche::loadBassa();
        return $not;
    }


    /** METODI DI FCARTITEM */

    public function prelevaCartItems($car){
        $s = FSessione::getInstance();
        return $s->getCarrello()->getDischi();
    }

    public function prelevaCartDischiItems($car){
        return FCartItem::loadD($car);
    }

    /**
     * Metodo che permette di aggiungere di una quantità il prodotto presente nel cartItem
     * @param $prodctId
     * @param $cartid
     * @param $cli_id
     */
    public function AddItem($prodctId, $cartid,$cli_id){
        return FCartItem::AddToCart($prodctId, $cartid,$cli_id);
    }

    /**
     * Metodo che permette di rimuovere di una quantità il prodotto presente nel cartItem
     * @param $prodctId
     * @param $cartid
     * @param $cli_id
     */
    public function MinusItem($prodctId, $cartid,$cli_id){
        return FCartItem::MinusToCart($prodctId, $cartid,$cli_id);
    }

    /** METODI DI FCARRELLO */

    public function prelevaCarrelloCorrente($id_cliente){
        return FCarrello::getCurrentCartId($id_cliente);
    }



    /** METODI DI FORDINE */

    public function AddOrdine($productarray, $cartid, $cli_id){
        return FOrdine::AddToOrdine($productarray, $cartid, $cli_id);
    }

    public function LoadOrdini($id_cli){
        return FOrdine::RecuperoOrdini($id_cli);
    }

    public function LoadOrdini_totale_ADMIN(){
        return FAdmin::RecuperoOrdini_totale_ADMIN();
    }

    public function checkQta($id){
        return FCartItem::CheckQta($id);
    }


}