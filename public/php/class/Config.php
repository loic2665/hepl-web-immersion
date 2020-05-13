<?php
//-- ---------------------------------------------------- -->
//--Auteurs : COLLETTE Loic et DELAVAL Kevin              -->
//--Groupe : 2203                                         -->
//--Labo : Programmation Web avancée                      -->
//--Application : Site d'immersion à l'école              -->
//--Date de la dernière mise à jour : 6/5/2020            -->
//-- ---------------------------------------------------- -->


class Config
{


    public static function areRegistrationOpen(){

        $file = json_decode(file_get_contents(__DIR__."/../../../config/settings.conf"));

        $now = time();

        if($file->force_registration == true){
            $open = true;
        }else if($file->force_close_registration == true){
            $open = false;
        }else if($now > $file->start_date && $now < $file->end_date) {
            $open = true;
        }else{
            $open = false;
        }

        return $open;

    }


    public static function isBetweenDate(){

        $file = json_decode(file_get_contents(__DIR__."/../../../config/settings.conf"));
        $now = time();
        if($now > $file->start_date && $now < $file->end_date) {
            $open = true;
        }else{
            $open = false;
        }
        return $open;

    }

    public static function setForceClose($value){

        if($value === true || $value === 1 || $value === "on" || $value === "1"){
            $value = true;
        }else{
            $value = false;
        }

        $file = json_decode(file_get_contents(__DIR__."/../../../config/settings.conf"));
        $file->force_close_registration = $value;

        $newFile = json_encode($file);
        file_put_contents(__DIR__."/../../../config/settings.conf", $newFile);


    }

    public static function setForceActive($value){

        if($value === true || $value === 1 || $value === "on" || $value === "1"){
            $value = true;
        }else{
            $value = false;
        }

        $file = json_decode(file_get_contents(__DIR__."/../../../config/settings.conf"));
        $file->force_registration = $value;

        $newFile = json_encode($file);
        file_put_contents(__DIR__."/../../../config/settings.conf", $newFile);


    }

    public static function setDateDebut($value){

        $value = strtotime($value);

        if(!is_int($value) || $value > Config::getDateFin()){
            return;
        }

        $file = json_decode(file_get_contents(__DIR__."/../../../config/settings.conf"));
        $file->start_date = $value;

        $newFile = json_encode($file);
        file_put_contents(__DIR__."/../../../config/settings.conf", $newFile);

    }

    public static function setDateFin($value){

        $value = strtotime($value);
        if(!is_int($value) || $value < Config::getDateDebut()){
            return;
        }

        $file = json_decode(file_get_contents(__DIR__."/../../../config/settings.conf"));
        $file->end_date = $value;

        $newFile = json_encode($file);
        file_put_contents(__DIR__."/../../../config/settings.conf", $newFile);

    }


    public static function getDateDebut(){
        $file = json_decode(file_get_contents(__DIR__."/../../../config/settings.conf"));
        return $file->start_date;
    }

    public static function getDateFin(){
        $file = json_decode(file_get_contents(__DIR__."/../../../config/settings.conf"));
        return $file->end_date;
    }

    public static function getAllConfig(){
        $file = json_decode(file_get_contents(__DIR__."/../../../config/settings.conf"));
        return $file;
    }

}