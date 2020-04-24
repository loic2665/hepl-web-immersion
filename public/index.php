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

                      <h1><b>Bienvenue !</b></h1>
                      <p>Bienvenue sur HEPL immersion ! LE site vous permettant
                      de vous inscrire aux journée découverte de la HEPL.</p>

                  </div>


              </div>

          </div>
          <div class="col-xl-6">

              <div class="status-block">

                  <div class="center white-text">
                      <?php if(false){ ?>

                          <h1>Les inscriptions sont actuellement <b>ouvertes</b> !</h1>
                          <p>
                              Les inscriptions sont ouvertes, depêchez-vous avant que toutes
                              les places soient prises.
                          </p>
                          <p><a class="btn btn-primary">Voir les cours</a></p>

                      <?php }else{ ?>

                          <h1>Les inscriptions ne sont <b>pas ouvertes</b>...</h1>
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

                      <h1><b>Cours disponibles</b></h1>
                      <span class="big-size count" data-value="120">

                      </span>

                  </div>

              </div>

          </div>
          <div class="col-xl-4">


              <div class="nb-profs-block">

                  <div class="center white-text">

                      <h1><b>Nombre de professeurs</b></h1>
                      <span class="big-size count" data-value="<?php echo(Enseignant::countTeachers()); ?>">
                      </span>

                  </div>

              </div>

          </div>
          <div class="col-xl-4">


              <div class="nb-days-block">

                  <div class="center white-text">

                      <h1><b>Journées restantes</b></h1>
                      <span class="big-size count" data-value="5">

                      </span>

                  </div>

              </div>


          </div>
      </div>
      <div class="row">
          <div class="col-xl-12">

              <div class="why-block">

                  <div class="center white-text">

                      <h1><b>Pourquoi ?</b></h1>
                      <span class="medium-size">
                          Suite à la demande de nos professeurs, il nous à été demandé de réaliser une plateforme
                          permettant aux étudiants, qu'ils soient en supérieur ou en 6<sup>ème</sup> secondaire, ceci
                          permettre d'avoir une vue plus globales sur les cours disponibles, les profs donnant ces cours,
                          les journées dédiée à la découverte de ces cours.
                      </span>

                  </div>


              </div>

          </div>
      </div>

  </section>

    <script>
        $('.count').each(function () {
            $(this).prop('Counter', 0).animate({
                Counter: $(this).data('value')
            }, {
                duration: 1000,
                easing: 'swing',
                step: function (now) {
                    $(this).text(this.Counter.toFixed(0));
                }
            });
        });
    </script>
</body>
</html>

