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

}
?>