<!-- ---------------------------------------------------- -->
<!--Auteurs : COLLETTE Loic et DELAVAL Kevin              -->
<!--Groupe : 2203                                         -->
<!--Labo : Programmation Web avancée                      -->
<!--Application : Site d'immersion à l'école              -->
<!--Date de la dernière mise à jour : 26/04/2020          -->
<!-- ---------------------------------------------------- -->


<script src="/js/jquery-3.4.1.js"></script>
<script src="/js/popper.js"></script>
<script src="/js/bootstrap.js"></script>

<script src="/js/toastr.min.js"></script>

<script>
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-bottom-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "2000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    function heartbeat(){

        $.ajax({
            type: "GET",                                           // type de requete
            url: "/api/heartbeat.php",
            dataType: "json",                                 // le type de data attendu par jquery
            success: function (result, data, xhrStatus) {     // si il correspond pas ou code http != 200 => callback dans error
                if(xhrStatus.status === 200){
                    if(result.error === true){
                        toastr["warning"](result.message, "Erreur");              // on affiche le toast
                    }else{
                        $("#update-secs").text(0).data("sec", 0);
                        //toastr["success"](result.message, "Succès");              // on affiche le toast
                        if(result.data.registrationOpen === false){
                            window.location = "/registrationClosed.php";
                        }

                    }
                }
            },
            error: function (result) {
                toastr["error"]("Le serveur ne réponds pas ou une erreur fatale s'est produite...", "Erreur !"); // toast..
            },
            complete: function(result){ // on execute le quoi que ce soit une erreur ou non

            },
        });

    }

    function addSecs() {
        let sec = $("#update-secs").data("sec");
        $("#update-secs").data("sec", sec + 1).text(sec + 1);
    }


    <?php if($_SERVER["SCRIPT_NAME"] != "/registrationClosed.php"){ ?>
        var heartBeatInterval = setInterval(heartbeat, 10000);
    <?php } ?>
        var secsUpdateInterval = setInterval(addSecs, 1000);



</script>

<link rel="stylesheet" href="/css/bootstrap.css">
<link rel="stylesheet" href="/css/toastr.min.css">
<link rel="stylesheet" href="/css/style.css">

<meta charset="utf-8" />

<?php

@session_start();

?>