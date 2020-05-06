<!-- ---------------------------------------------------- -->
<!--Auteurs : COLLETTE Loic et DELAVAL Kevin              -->
<!--Groupe : 2203                                         -->
<!--Labo : Programmation Web avancée                      -->
<!--Application : Site d'immersion à l'école              -->
<!--Date de la dernière mise à jour : 06/05/2020          -->
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
                <a class="nav-link" href="/admin">Accueil<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item"> <!-- permet d'envoyer la valeur enseignants à la page gerer.php via $_GET -->
                <a class="nav-link" href="/admin/gerer.php?gerer=enseignants">Gérer les professeurs</a>
            </li>
            <li class="nav-item"> <!-- permet d'envoyer la valeur eleves à la page gerer.php via $_GET -->
                <a class="nav-link" href="/admin/gerer.php?gerer=eleves">Gérer les élèves</a>
            </li>
            <li class="nav-item"> <!-- permet d'envoyer la valeur cours à la page gerer.php via $_GET -->
                <a class="nav-link" href="/admin/gerer.php?gerer=cours">Gérer les cours</a>
            </li>
            <li class="nav-item"> <!-- permet d'envoyer la valeur horaires à la page gerer.php via $_GET -->
                <a class="nav-link" href="/admin/gerer.php?gerer=horaires">Gérer l'horraire</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Gérer...
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <?php
                    $gerer = addslashes(htmlspecialchars($_GET['gerer']));
                    $db = new Database();
                    $result = $db->conn->query("SHOW TABLES;");

                    foreach ($result->fetchAll(PDO::FETCH_NUM) as $tableName){
                    ?>
                        <a class="dropdown-item" href="/admin/gerer.php?gerer=<?php echo($tableName[0]); ?>"><?php echo($tableName[0]); ?></a>
                    <?php } ?>
                </div>
            </li>
        </ul>
    </div>
</nav>