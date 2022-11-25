<?php
/**
 * ok
 * @package Entity
 */

class EArtista extends EUtente{

	private string $IdArtista;

    private string $NomeArte;

	private $Album = array();

	private ?string $IBAN = null;

    public function __construct(){
        if (11 === func_num_args()){
            $n = func_get_arg(0);
            $c = func_get_arg(1);
            $v = func_get_arg(2);
            $nc = func_get_arg(3);
            $citta = func_get_arg(4);
            $prov = func_get_arg(5);
            $cap = func_get_arg(6);
            $telefono = func_get_arg(7);
            $email = func_get_arg(8);
            $pw = func_get_arg(9);
            $nom_arte = func_get_arg(10);

            parent::__construct($n, $c, $v, $nc,$citta,$prov,$cap,$telefono,$email,$pw);
            parent::setLivello("B");
            $this->IdArtista = "B"  . random_int(0,999);
            $this->NomeArte=$nom_arte;
        }
        elseif (12 === func_num_args()){
            $n = func_get_arg(0);
            $c = func_get_arg(1);
            $v = func_get_arg(2);
            $nc = func_get_arg(3);
            $citta = func_get_arg(4);
            $prov = func_get_arg(5);
            $cap = func_get_arg(6);
            $telefono = func_get_arg(7);
            $email = func_get_arg(8);
            $pw = func_get_arg(9);
            $nom_arte = func_get_arg(10);
            $id_artista = func_get_arg(11);
            parent::__construct($n, $c, $v, $nc,$citta,$prov,$cap,$telefono,$email,$pw);
            parent::setLivello("B");
            $this->NomeArte = $nom_arte;
            $this->IdArtista = $id_artista;
        }
    }

	public function addAlbum(EDisco $d){
		array_push($this->Album, $d);
	}	

    /**metodi get**/

	public function getIdArtista(): string
	{ return $this->IdArtista; }

	public function getIban(): string
	{ return $this->IBAN; }

    public function getNomeArte(): string {
        return $this->NomeArte; }

    /**metodi set**/

	public function setIdArtista(string $a): void
	{ $this->IdArtista = $a; }

	public function setIban(string $i): void
	{ $this->IBAN = $i; }

    public function setNomeArte(string $n): void {
        $this->NomeArte = $n; }
}

?>