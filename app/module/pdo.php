<?php
class PDOdb
{

    private $dsn = "mysql:host=localhost;dbname=ofpptdb";
    private $user  = "root";
    private $password  = "";
    private $connection = null;

    public function ConnecteToDB()
    {
        try {
            $this->connection = new PDO($this->dsn, $this->user, $this->password);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
    public function SelectQeurys($q)
    {
        $rs = $this->connection->query($q);
        return $rs;
    }
    public function updateQeurys($q)
    {
        $rs = $this->connection->exec($q);
        return $rs;
    }
}
