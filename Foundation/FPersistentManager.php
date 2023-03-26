<?php

class FPersistentManager{

    private static $instance;

	public static function getInstance() {
		if(!isset(self::$instance)){
			self::$instance = new FPersistentManager();
		}
		return self::$instance;
	}
  //TODO: dopo classi foundation aggiornare
    public function exist(string $Fclass, $key1, $key2=null) : bool {
        $ris = $Fclass::exist($key1,$key2);
        return $ris;
    }

    public function exist_username(string $Fclass, $key1) : bool {
        $ris = $Fclass::exist_username($key1);
        return $ris;
    }


    /**
     * metodo che permette il caricamento di un elemento di una classe
     * tramite la chiave primaria dell'oggetto
     */
    public function load(string $Fclass, $key1) {
        $object = $Fclass::load($key1);
        return $object;
    }


    public function store(object $obj,$mailutente=null)  {
        $Eclass = get_class($obj);
        $Fclass = str_replace("E", "F", $Eclass);
        $ris = $Fclass::store($obj,$mailutente);

    }


    public function delete(string $Fclass, $key1, $key2=null, $key3=null) : bool {
        $ris = $Fclass::delete($key1,$key2,$key3);
        return $ris;
    }

    public function update(object $obj) : bool {
        $Eclass = get_class($obj);
        $Fclass = str_replace("E", "F", $Eclass);
        $ris = $Fclass::update($obj);
        return $ris;
    }

    /**
     * metodo che permette l'aggiornamento del valore di un campo passato per parametro
     */
    public function update_value(string $class, string $attributo, string $newvalue, string $attributo_pk, string $value_pk) {
        return $class::update($attributo, $newvalue, $attributo_pk, $value_pk);
    }

    /**
     * Metodo che permette il login di un utente, date le credenziali (email e password)
     * @param $email
     * @param $password
     */
    public function verificaLogin($email, $password) {
        $ris = FCliente::verificaAccesso($email, $password);
        if($ris == null){
            $ris = FArtista::verificaAccesso($email, $password);
            if($ris == null){
                $ris = FAdmin::verificaAccesso($email, $password);
            }
        }
        return $ris;
    }

    public static function criptaPassword($password): string {
        return EUtente::criptaPassword($password);
    }

    /** METODI DI FDisco */

	public function prelevaDischi() : array {
        return FDisco::prelevaDischi();
	}
    public function prelevaDischiperGen($genere):array {
        return FDisco::prelevaDischiperGenere($genere);
    }
    public function prelevaDischiperAutore($aut){
        $disco = $this->FindArtistId($aut);
        return FDisco::prelevaDischiperAutore($disco);
    }

    public function prelevaDischiperIDAutore($aut){
        return FDisco::prelevaDischiperAutore($aut);
    }

    //TODO: vedere il caso in cui non trova i dischi

    public function prelevaDischiperTitolo($titolo):array{
        return FDisco::prelevaDischiperTitolo($titolo);
    }

    /** METODI DI FSondaggio */

    public function prelevaSondaggioInCorso(){
        $sondaggio = FSondaggio::load_incorso();
        return $sondaggio;
    }
    public function prelevaSondaggi(){
        $sondaggi = FSondaggio::prelevaSondaggi();
        return $sondaggi;
    }

    public function prelevaRichieste(){
        $richieste = FRichiesta::load_richieste();
        return $richieste;
    }

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

    public function crea_sondaggio(ESondaggio $sondaggio){
        FSondaggio::store($sondaggio);
        FRichiesta::delete($sondaggio->getDisco1());
        FRichiesta::delete($sondaggio->getDisco2());
        FRichiesta::delete($sondaggio->getDisco3());

    }

    public function prelevaDischiSondaggio(ESondaggio $sondaggio): array {
        $disco1 = $sondaggio->getDisco1();
        $disco2 = $sondaggio->getDisco2();
        $disco3 = $sondaggio->getDisco3();
        $load_disco1 = FDisco::load($disco1);
        $load_disco2 = FDisco::load($disco2);
        $load_disco3 = FDisco::load($disco3);
        $dischi = array($load_disco1,$load_disco2,$load_disco3);
        return $dischi;
    }

    public function prelevaOrdini($ut){
        $ordini = FOrdine::prelevaOrdini($ut);
        return $ordini;
    }

    public function prelevaArtisti(){
        $artisti = FArtista::loadArtisti();
        return $artisti;
    }

    public function prelevaArtistiperUsername($username):array{
        $artisti = FArtista::loadArtistiperUsername($username);
        return $artisti;
    }

    public function prelevaClienti(){
        $clienti = FCliente::loadClienti();
        return $clienti;
    }

    public function prelevaGeneri(){
        $gen = FAdmin::loadgeneri();
        return $gen;
    }


    public function prelevaComProd(string $id){
        $com = FCommento::prelevaCommentiperDisco($id);
        return $com;
    }

    public function prelNotifAlte(){
        $not = FNotifiche::loadAlta();
        return $not;
    }


    public function prelNotifBasse(){
        $not = FNotifiche::loadBassa();
        return $not;
    }

    public function prelNotifSond(){
        $not = FNotifiche::loadSond();
        return $not;
    }

    public function prelevaCartItems($car){
        return FCartItem::load($car);
    }

    public function prelevaCartDischiItems($car){
        return FCartItem::loadD($car);

    }

    public function prelevaCarrelloCorrente($id_cliente){
        return FCarrello::getCurrentCartId($id_cliente);
    }

    public function AddItem($prodctId, $cartid,$cli_id){
        return FCartItem::AddToCart($prodctId, $cartid,$cli_id);
    }

    public function MinusItem($prodctId, $cartid,$cli_id){
        return FCartItem::MinusToCart($prodctId, $cartid,$cli_id);
    }

    public function FindArtistName($id){
        return FArtista::loadName($id);
    }
    public function FindArtistId($username){
        return FArtista::loadId($username);
    }

    public function loadCommenti($disco){
        return FCommento::loadCommenti($disco);
    }

    public function AddOrdine($productarray, $cartid, $cli_id){
        return FOrdine::AddToOrdine($productarray, $cartid, $cli_id);
    }

    public function LoadOrdini($id_cli){
        return FOrdine::RecuperoOrdini($id_cli);
    }

    public function loadmpCommenti($cl,$dc){
        return FVotazioneCommento::loadMP($cl,$dc);
    }

    public function loadNumeroMP($dc){
        return FVotazioneCommento::loadNumeroMP($dc);
    }

    public function ArtistaFromID($id){
        return FArtista::loadFromID($id);
    }





}