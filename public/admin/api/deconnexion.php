<!-- ---------------------------------------------------- -->
<!--Auteurs : COLLETTE Loic et DELAVAL Kevin              -->
<!--Groupe : 2203                                         -->
<!--Labo : Programmation Web avancée                      -->
<!--Application : Site d'immersion à l'école              -->
<!--Date de la dernière mise à jour : 15/05/2020          -->
<!-- ---------------------------------------------------- -->


<?php
@session_start();


$_SESSION["idProfil"] = null;

header('Location: ../../admin');
