<?php


class Database
{

    private $host = "localhost";
    private $port = 3306;
    private $user = "root";
    private $pass = "root";
    private $name = "hepl-immersion";

    public $conn = null;

    public function __construct(){

        try{
            $this->conn = new PDO("mysql:host=".$this->host.";dbname=".$this->name, $this->user, $this->pass);
        }catch (Exception $e){
            die("Connection to database cannot be etablished, error : ". $e->getMessage());
        }


    }

}