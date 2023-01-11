<?php

class Element_Traiter
{
    private $id;
    private $element;
    private $donnees;
    private $aspeets_traiter;
    private $commentType;
    private $commants;

    public function __construct($id, $element, $donnees, $aspeets_traiter, $commentType)
    {
        $this->id = $id;
        $this->element = $element;
        $this->donnees = $donnees;
        $this->aspeets_traiter = $aspeets_traiter;
        $this->commentType = $commentType;
        $this->commants = null;
    }

    public function GetId()
    {
        return $this->id;
    }
    public function GetElement()
    {
        return $this->element;
    }
    public function GetDonnees()
    {
        return $this->donnees;
    }
    public function GetAspeets_traiter()
    {
        return $this->aspeets_traiter;
    }
    public function GetCommentType()
    {
        return $this->commentType;
    }
    public function GetComment()
    {
        return $this->commants;
    }
    public function SetId($p)
    {
        $this->id = $p;
    }
    public function SetElement($p)
    {
        $this->element = $p;
    }
    public function SetDonnees($p)
    {
        $this->donnees = $p;
    }
    public function SetAspeets_traiter($p)
    {
        $this->aspeets_traiter = $p;
    }
    public function SetCommentType($p)
    {
        $this->commentType = $p;
    }
    public function SetComment($p)
    {
        $this->commants = $p;
    }
}
