<!-- ---------------------------------------------------- -->
<!--Auteurs : COLLETTE Loic et DELAVAL Kevin              -->
<!--Groupe : 2203                                         -->
<!--Labo : Programmation Web avancée                      -->
<!--Application : Site d'immersion à l'école              -->
<!--Date de la dernière mise à jour : 26/04/2020          -->
<!-- ---------------------------------------------------- -->


<?php require_once(__DIR__."/php/require_all.php"); ?>


<html>
  <head>
      <title>Immersion HEPL - Accueil</title>
    <?php require_once(__DIR__."/inc/head.php"); ?>
  </head>
  <body>

  <?php require_once(__DIR__."/inc/nav.php"); ?>

  <section>

      <div class="row">
          <div class="col-xl-6">

              <div class="welcome-block">

                  <div class="center white-text">

                        <h1>Bienvenue !</h1>
                      <p>Bienvenue sur HEPL immersion ! LE site vous permettant
                      de vous inscrire aux journée découverte de la HEPL.</p>

                  </div>


              </div>

          </div>
          <div class="col-xl-6">

              <div class="status-block">

                  <div class="center white-text">
                      <?php if(false){ ?>

                          <h1>Les inscriptions sont actuellement ouvertes !</h1>
                          <p>
                              Les inscriptions sont ouvertes, depêchez-vous avant que toutes
                              les places soient prises.
                          </p>
                          <p><a class="btn btn-primary">Voir les cours</a></p>

                      <?php }else{ ?>

                          <h1>Les inscriptions ne sont pas ouvertes...</h1>
                          <p>
                            Recevez un mail quand les inscriptions seront ouvertes
                          </p>
                          <p><a class="btn btn-warning">M'inscrire</a></p>

                      <?php } ?>

                  </div>
              </div>

          </div>
      </div>
      <div class="row">
          <div class="col-xl-4">


              <div class="nb-cours-block">

                  <div class="center white-text">

                      <h1>Nombre de cours disponibles</h1>
                      <p>
                          <?php try { echo(Cours::countAllCourses()); }catch (Error $e){ echo($e->getMessage()); } ?>
                      </p>

                  </div>

              </div>

          </div>
          <div class="col-xl-4">


              <div class="nb-profs-block">

                  <div class="center white-text">

                      <h1>Nombre de cours disponibles</h1>
                      <p>
                          <?php try { echo(Enseignant::countAllTeachers()); }catch (Error $e){ echo($e->getMessage()); } ?>
                      </p>

                  </div>

              </div>

          </div>
          <div class="col-xl-4">


              <div class="nb-days-block">

                  <div class="center white-text">

                      <h1>Cours disponibles</h1>
                      <p>
                          <?php try { echo(Cours::HowMuchDayRemaining()); }catch (Error $e){ echo($e->getMessage()); } ?>
                      </p>

                  </div>

              </div>


          </div>
      </div>
      <div class="row">
          <div class="col-xl-12">

              <div class="why-block">

              </div>

          </div>
      </div>

  </section>


</body>
</html>

