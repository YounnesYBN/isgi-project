

<?php
class Table_association
{
    private $id;
    private $commantaire;
    private $element;

    public function __construct($id, $commantaire, $element)
    {
        $this->id = $id;
        $this->commantaire = $commantaire;
        $this->element = $element;
    }

    public function GetId()
    {
        return $this->id;
    }
    public function Getcommantaire()
    {
        return $this->commantaire;
    }
    public function GetElement()
    {
        return $this->element;
    }
    public function SetId($p)
    {
        $this->id  = $p;
    }
    public function Setcommantaire($p)
    {
        $this->commantaire  = $p;
    }
    public function SetElement($p)
    {
        $this->element  = $p;
    }
}

?>