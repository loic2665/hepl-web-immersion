<!-- ---------------------------------------------------- -->
<!--Auteurs : COLLETTE Loic et DELAVAL Kevin              -->
<!--Groupe : 2203                                         -->
<!--Labo : Programmation Web avancée                      -->
<!--Application : Site d'immersion à l'école              -->
<!--Date de la dernière mise à jour : 26/04/2020          -->
<!-- ---------------------------------------------------- -->


<nav class="navbar navbar-expand-lg navbar-dark bg-primary" id="section-0">
    <a class="navbar-brand" href="#"><img class="nav-logo" alt="HEPL IMMERSION" src="/img/logo.png"/></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01"
            aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor01">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/">Accueil <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/liste_cours.php">Liste des cours</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/voirInscription.php">Voir mon inscription</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/contact.php">Contact</a>
            </li>
        </ul>
        <span class="navbar-text">
            Mis à jour il y a <span data-sec="0" id="update-secs">{secs}</span> secondes.
    </span>
    </div>
</nav>

<script>


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


    $("#loader-spinner").show();
    $(document).ready(function () {
        $("#loader-spinner").hide();
    });


</script>


<div id="loader-spinner">
    <img alt="loading..." src="/img/loading.gif" />
    <p>Chargement en cours...</p>
</div>


