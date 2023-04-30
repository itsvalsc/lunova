<?php

/** La classe EImmagine caratterizza l'immagine di un cd, o del profilo di un utente(artista o cliente) attraverso:
 * Id: identificativo dell'immagine
 * nome: identifica il nome dell'immagine
 * formato: identifica il formato dell'immagine (es. jpg, jpeg, ecc.)
 * Immagine: la codifica in base 64 dell'immagine
 * IdAppartenenza: identifica l'id della classe di appartenenza dell'immagine(i.e. se è la copertina di un disco o l'immagine profilo di un artista o cliente)
 */

class EImmagine {

    private string $Id;
    private string $nome;
    private string $formato;
    private string $Immagine;
    private string $IdAppartenenza;

    /**
     * @param string $nome
     * @param string $formato
     * @param string $Immagine
     * @param string $IdAppartenenza
     */
    public function __construct(string $nome, string $formato, string $Immagine, string $IdAppartenenza)
    {
        $this->Id = ("I".random_int(0,1000));
        $this->nome = $nome;
        $this->formato = $formato;
        $this->Immagine = $Immagine;
        $this->IdAppartenenza = $IdAppartenenza;
    }

    /** METODI GET */

    public function getId(): string
    { return $this->Id; }

    public function getNome(): string
    { return $this->nome; }

    public function getFormato(): string
    { return $this->formato; }

    public function getImmagine(): string
    { return $this->Immagine; }

    public function getIdAppartenenza(): string
    { return $this->IdAppartenenza; }

   /** METODI SET */

    public function setId(string $Id): void
    { $this->Id = $Id; }

    public function setNome(string $nome): void
    { $this->nome = $nome; }

    public function setFormato(string $formato): void
    { $this->formato = $formato; }

    public function setImmagine(string $Immagine): void
    { $this->Immagine = $Immagine; }

    public function setIdAppartenenza(string $IdAppartenenza): void
    { $this->IdAppartenenza = $IdAppartenenza; }
}