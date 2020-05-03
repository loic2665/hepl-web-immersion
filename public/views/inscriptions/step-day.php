<?php
//-- ---------------------------------------------------- -->
//--Auteurs : COLLETTE Loic et DELAVAL Kevin              -->
//--Groupe : 2203                                         -->
//--Labo : Programmation Web avancée                      -->
//--Application : Site d'immersion à l'école              -->
//--Date de la dernière mise à jour : [27/4/2020]         -->
//-- ---------------------------------------------------- -->

/*
 *
 * Pour + de facilité, indiquer ici les variables qui sont prête à être utilisée.
 * Sinon les instancier dans le fichier de fonction
 *
 *
 *
 * */


?>

<h1 id="step-day-<?php echo($jour); ?>-title">Incription - Jour <?php echo($jour); ?></h1>
<div id="class-step-<?php echo($jour); ?>" class="no-parent-style">

    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#home">Bloc 1</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#profile">Bloc 2</a>
        </li>
    </ul>
    <div id="myTabContent" class="tab-content">
        <div class="tab-pane fade" id="home">
            <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.</p>
        </div>
        <div class="tab-pane fade active show" id="profile">
            <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit.</p>
        </div>
        <div class="tab-pane fade" id="dropdown1">
            <p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork.</p>
        </div>
        <div class="tab-pane fade" id="dropdown2">
            <p>Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche high life echo park Austin. Cred vinyl keffiyeh DIY salvia PBR, banh mi before they sold out farm-to-table VHS viral locavore cosby sweater.</p>
        </div>
    </div>


</div>

<style>
#class-step-<?php echo($jour); ?>{

    width: 98%;

}

</style>




<!-- todo: on affiche les 3 bloc dans list-group-item
    au clic de celui-ci on affiche a l'aide jquery et de l'api
    d'afficher les cours dispo dans ce bloc à l'horaire donné

    donc 4x le list group item avec les 3 blocs
-->

<?php
//code a executer en fin de "boucle"

$jour++;

?>