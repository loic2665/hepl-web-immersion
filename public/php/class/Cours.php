<?php

require_once(__DIR__."/Database.php");

class Cours
{

    public static function getAllCourses(){

        $db = new Database();

        $result = $db->conn->query("SELECT * FROM cours ORDER BY tranche_horaire, bloc");
        $array = $result->fetchAll(PDO::FETCH_ASSOC);

        return str_replace('\'', ' ', json_encode($array));

    }

    public static function getCoursesByName($name){

        $db = new Database();

        $result = $db->conn->query("SELECT * FROM cours WHERE nom like '%".$name."%' ORDER BY tranche_horaire, bloc");
        $array = $result->fetchAll();

        return $array;

    }

}