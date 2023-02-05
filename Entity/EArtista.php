<?php
/**
 * ok
 * @package Entity
 */

class EArtista extends EUtente{

	private string $IdArtista;

    protected string $Username;

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

            parent::__construct($nom_arte,$n, $c, $v, $nc, $citta, $prov, $cap, $telefono, $email, $pw);
            parent::setLivello("B");
            $this->IdArtista = "B"  . random_int(0,999);
            $this->Username=$nom_arte;
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

            parent::__construct($nom_arte,$n, $c, $v, $nc,$citta,$prov,$cap,$telefono,$email,$pw);
            parent::setLivello("B");
            $this->Username = $nom_arte;
            $this->IdArtista = $id_artista;
        }
    }

	public function addAlbum(EDisco $d){
		array_push($this->Album, $d);
	}

    /** METODI GET*/

	public function getIdArtista(): string
	{ return $this->IdArtista; }

	public function getIban(): string
	{ return $this->IBAN; }

    public function getUsername(): string
    { return $this->Username; }

    public function getAlbum(): array
    { return $this->Album; }

    /** METODI SET*/

	public function setIdArtista(string $a): void
	{ $this->IdArtista = $a; }

	public function setIban(string $i): void
	{ $this->IBAN = $i; }

    public function setUsername(string $n): void {
        $this->Username = $n; }

    /** ALTRI METODI*/

    /**
     * Metodo che cripta la password inserita da un utente con un hash
     * da 60 caratteri
     * @param string $password
     * @return string
     */
    public static function criptaPassword(string $password): string {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    /**
     * Metodo che verifica la password inserita corrisponda all'hash
     * nel database
     * @param string $password
     * @return string
     */
    public static function verificaPassword(string $password, string $hash): bool {
        return password_verify($password, $hash);
    }

}

?>