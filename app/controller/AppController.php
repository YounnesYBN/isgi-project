<?php
include dirname(__DIR__) . "../module/pdo.php";
include dirname(__DIR__) . "../module/user.php";
include dirname(__DIR__) . "../module/aspeets_traiter.php";
include dirname(__DIR__) . "../module/Commantaire.php";
include dirname(__DIR__) . "../module/table_association.php";
include dirname(__DIR__) . "../module/tableGlobale.php";


class AppController
{

    public $AllUsers = array();
    public $AllElement = array();
    public $AllCommantaire = array();
    public $AllTable_association = array();
    public $AllAspeets_traiter = array();


    public function CheckConnectionDB()
    {
        $db = new PDOdb();
        return $db->ConnecteToDB();
    }

    public function GetAllUsers()
    {
        $db = new PDOdb();
        $db->ConnecteToDB();
        $q = "select * from utilisateur";
        $rs = $db->SelectQeurys($q);
        while ($line = $rs->fetch()) {
            $user = new User($line["id"], $line["email"], $line["password"], $line["type"]);
            $this->AllUsers[] = $user;
        }
    }

    public function GetAllElement()
    {
        $db = new PDOdb();
        $db->ConnecteToDB();
        $q = "SELECT 
    table_globale.id as id_glo ,
    element_traitement,
    aspeets_traiter.id as id_asp ,
    aspeets_traiter.libelle ,
    donnees
    FROM 
    table_globale 
    INNER join aspeets_traiter on 
    table_globale.id_aspeets_traiter = aspeets_traiter.id
    ;";
        $rs = $db->SelectQeurys($q);
        while ($line = $rs->fetch()) {
            $aspeets_traiter = new Aspeets_traiter($line["id_asp"], $line["libelle"]);
            $element = new Element_Traiter($line["id_glo"], $line["element_traitement"], $line["donnees"], $aspeets_traiter);
            $this->AllElement[] = $element;
        }
    }
    public function GetAllAspeets_traiter()
    {
        $db = new PDOdb();
        $db->ConnecteToDB();
        $q = "SELECT * FROM aspeets_traiter;";
        $rs = $db->SelectQeurys($q);
        while ($line = $rs->fetch()) {
            $aspeets_traiter = new Aspeets_traiter($line["id"], $line["libelle"]);

            $this->AllAspeets_traiter[] = $aspeets_traiter;
        }
    }

    public function GetAllCommantaire()
    {
        $db = new PDOdb();
        $db->ConnecteToDB();
        $q = "SELECT commantaire.id as id_com, text_commantaire , utilisateur.id as id_uti, utilisateur.email, utilisateur.password, utilisateur.type FROM commantaire INNER join utilisateur on commantaire.id_utilisateur = utilisateur.id;";
        $rs = $db->SelectQeurys($q);
        while ($line = $rs->fetch()) {
            $user = new User($line["id_uti"],$line["email"],$line["password"],$line["type"]);
            $commantaire = new Commantaire($line["id_com"],$line["text_commantaire"],$user);

            $this->AllCommantaire[] = $commantaire;
        }
    }
    public function GetAllTable_association()
    {
        $db = new PDOdb();
        $db->ConnecteToDB();
        $q = "select 
        table_association.id as id_aso,
        commantaire.id as id_com ,
        commantaire.text_commantaire,
        utilisateur.id as id_uti,
        utilisateur.email,
        utilisateur.password ,
        utilisateur.type ,
        table_globale.id as id_ele,
        table_globale.element_traitement,
        table_globale.donnees,
        aspeets_traiter.id as id_asp,
        aspeets_traiter.libelle 
        from table_association
        
        INNER JOIN commantaire on table_association.id_commantaire = commantaire.id
        INNER JOIN table_globale on table_association.id_Element_Traitement = table_globale.id
        INNER JOIN  utilisateur on commantaire.id_utilisateur = utilisateur.id
        INNER JOIN aspeets_traiter on table_globale.id_aspeets_traiter = aspeets_traiter.id";
        $rs = $db->SelectQeurys($q);
        while ($line = $rs->fetch()) {
            $user = new User($line["id_uti"], $line["email"], $line["password"], $line["type"]);
            $aspeets_traiter = new Aspeets_traiter($line["id_asp"], $line["libelle"]);
            $element = new Element_Traiter($line["id_ele"], $line["element_traitement"], $line["donnees"], $aspeets_traiter);
            $commantaire = new Commantaire($line["id_com"],$line["text_commantaire"],$user);
            $table_association = new Table_association($line["id_aso"],$commantaire,$element);
            $this->AllTable_association[] = $table_association ;
        }
    }

}
