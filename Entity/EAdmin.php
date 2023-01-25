<?php
/**
 * ok
 * @package Entity
 */

class EAdmin extends EUtente{

	private string $IdAdmin;

	public function __construct(string $n, string $c, string $v, string $nc, string $citta, string $prov, string $cap, string $telefono, string $email, string $pw)
	{
		parent::__construct($n, $c, $v, $nc, $citta, $prov, $cap, $telefono, $email, $pw);
		parent::setLivello("A");
		$this-> IdAdmin = "A" . random_int(0,1000);
	}

    public function getIdAmministratore(): string
    { return $this->IdAmministratore; }

	public function setIdAmministratore(string $IdAmministratore): void
    { $this->IdAmministratore = $IdAmministratore; }

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