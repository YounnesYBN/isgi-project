<?php
class Aspeets_traiter
{
    private $id;
    private $libelle;

    public function __construct($id, $libelle)
    {
        $this->id = $id;
        $this->libelle = $libelle;
    }

    public function GetId()
    {
        return $this->id;
    }
    public function GetLibelle()
    {
        return $this->libelle;
    }
    public function SetId($p)
    {
        $this->id  = $p;
    }
    public function SetLibelle($p)
    {
        $this->libelle  = $p;
    }
}
