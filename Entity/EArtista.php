<?php
/**
 * La classe EArtista estende la classe EUtente con degli attributi caratterizzanti attraverso:
 ** IdArtista: id che identifica l'artista in modo univoco
 ** Album: array di canzoni che identificano l'album dell'artista
 *  @package Entity
 */

class EArtista extends EUtente{

	private string $IdArtista;
	private $Album = array();
    private int $Bannato;


    public function __construct(){
        if (11 === func_num_args()){
            $nom_arte = func_get_arg(0);
            $n = func_get_arg(1);
            $c = func_get_arg(2);
            $v = func_get_arg(3);
            $nc = func_get_arg(4);
            $citta = func_get_arg(5);
            $prov = func_get_arg(6);
            $cap = func_get_arg(7);
            $telefono = func_get_arg(8);
            $email = func_get_arg(9);
            $pw = func_get_arg(10);


            parent::__construct($nom_arte,$n, $c, $v, $nc, $citta, $prov, $cap, $telefono, $email, $pw);
            parent::setLivello("B");
            $this->IdArtista = "B"  . random_int(0,9999);
            $this->Username=$nom_arte;
            $this->Bannato=0;
        }
        elseif (13 === func_num_args()){
            $nom_arte = func_get_arg(0);
            $email = func_get_arg(1);
            $n = func_get_arg(2);
            $c = func_get_arg(3);
            $v = func_get_arg(4);
            $nc = func_get_arg(5);
            $citta = func_get_arg(6);
            $prov = func_get_arg(7);
            $cap = func_get_arg(8);
            $telefono = func_get_arg(9);
            $pw = func_get_arg(10);
            $id_artista = func_get_arg(11);

            parent::__construct($nom_arte,$n, $c, $v, $nc,$citta,$prov,$cap,$telefono,$email,$pw);
            parent::setLivello("B");
            $this->IdArtista = $id_artista;
            $this->Bannato = func_get_arg(12);
        }
    }

    /** METODI GET*/

	public function getIdArtista(): string
	{ return $this->IdArtista; }

    public function getUsername(): string
    { return $this->Username; }

    public function getAlbum(): array
    { return $this->Album; }

    public function getBannato(): int
    { return $this->Bannato; }

    /** METODI SET*/

	public function setIdArtista(string $a): void
	{ $this->IdArtista = $a; }

    public function setUsername(string $n): void {
        $this->Username = $n; }

    public function setBannato(int $ban): void
    { $this->Bannato = $ban; }
}

?>