<?php
/***********************************************************/
/*Auteurs : COLLETTE Loic et DELAVAL Kevin                 */
/*Groupe : 2203                                            */
/*Labo : Programmation Web avancée                         */
/*Application : Site d'immersion à l'école                 */
/*Date de la dernière mise à jour : 26/04/2020             */
/***********************************************************/


class Database
{

    private $host = "localhost";
    private $port = 3306;
    private $user = "root";
    private $pass = "";
    private $name = "hepl-immersion";

    public $conn = null;

    /*connection à la base de données*/
    public function __construct()
    {

        try
        {                                                                                                          /* force l'UTF8 */
            $this->conn = new PDO("mysql:host=".$this->host.";dbname=".$this->name, $this->user, $this->pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
        }
        catch (Exception $e)
        {
            die("Connection to database cannot be etablished, error : ". $e->getMessage());
        }


    }

}