<?php 
class User{
    private $id ;
    private $name ;
    private $password ;
    private $type ;

    public function __construct($id,$name,$password,$type)
    {
        $this->id = $id;
        $this->name = $name;
        $this->password = $password;
        $this->type = $type;
    }
    
    public function GetId(){
        return $this->id;
    }
    public function GetName(){
        return $this->name;
    }
    public function GetPassword(){
        return $this->password;
    }
    public function GetType(){
        return $this->type;
    }
    
    public function SetId($p){
         $this->id = $p;
    }
    public function SetName($p){
         $this->name = $p;
    }
    public function SetPassword($p){
         $this->password = $p;
    }
    public function SetType($p){
         $this->type = $p;
    }

}


?>