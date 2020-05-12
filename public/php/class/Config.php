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
}