<?php

/**
 * Class EImmagine
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

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->Id;
    }

    /**
     * @return string
     */
    public function getNome(): string
    {
        return $this->nome;
    }

    /**
     * @return string
     */
    public function getFormato(): string
    {
        return $this->formato;
    }

    /**
     * @return string
     */
    public function getImmagine(): string
    {
        return $this->Immagine;
    }

    /**
     * @return string
     */
    public function getIdAppartenenza(): string
    {
        return $this->IdAppartenenza;
    }

    /**
     * @param string $Id
     */
    public function setId(string $Id): void
    {
        $this->Id = $Id;
    }

    /**
     * @param string $nome
     */
    public function setNome(string $nome): void
    {
        $this->nome = $nome;
    }

    /**
     * @param string $formato
     */
    public function setFormato(string $formato): void
    {
        $this->formato = $formato;
    }

    /**
     * @param string $Immagine
     */
    public function setImmagine(string $Immagine): void
    {
        $this->Immagine = $Immagine;
    }

    /**
     * @param string $IdAppartenenza
     */
    public function setIdAppartenenza(string $IdAppartenenza): void
    {
        $this->IdAppartenenza = $IdAppartenenza;
    }


}