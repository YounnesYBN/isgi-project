<?php 

class Commantaire{

    private $id ;
    private $text_commantaire ;
    private $utilisateur ;

    public function __construct($id,$text_commantaire,$utilisateur)
    {
        $this->id = $id ;
        $this->text_commantaire = $text_commantaire ;
        $this->utilisateur = $utilisateur ;
    }

    public function GetId(){
        return $this->id ;
    }
    public function GetText_commantaire(){
        return $this->text_commantaire ;
    }
    public function GetUtilisateur(){
        return $this->utilisateur ;
    }

    public function SetId($p){
         $this->id  = $p;
    }
    public function SetText_commantaire($p){
         $this->text_commantaire  = $p;
    }
    public function SetUtilisateur($p){
         $this->utilisateur  = $p;
    }
}

?>