<?php
//-- ---------------------------------------------------- -->
//--Auteurs : COLLETTE Loic et DELAVAL Kevin              -->
//--Groupe : 2203                                         -->
//--Labo : Programmation Web avancée                      -->
//--Application : Site d'immersion à l'école              -->
//--Date de la dernière mise à jour : [DATE DU JOUR]      -->
//-- ---------------------------------------------------- -->

require_once(__DIR__."/../../php/require_all.php");
require_once(__DIR__."/../../../mpdf-6.1.3/mpdf.php");

$mpdf = new Mpdf();
ob_start();

$date = date("d/m/Y", time());

$mpdf->showWatermarkText = true;
$mpdf->SetProtection([], "", "");

?>

<img style="width: 120px; height: auto" src="/img/logo-rouge.png" />
<br /><br />
<div style="text-align: left">
    Haute École de la province de Liège<br />
    Rue Peetermans, 81<br />
    4100, Seraing<br />
    Belgique
</div>
<br />
<br />
<br />
<p>
Je sousigné .........................,
<br />
<br />
Atteste bien que NOM PRENOM à bien assisté aux cours d\'immersion ce <?php echo($date); ?> à la HEPL de Seraing
situé Rue Peetermans, 81 à 4100 Seraing.
<br/>
<br/>
L étudiant à suivi les cours suivant :

<p>COurs très passionnant<br/>COurs très passionnant<br/>COurs très passionnant<br/>COurs très passionnant<br/></p>

<div style="text-align: right">
    Fait le  <?php echo($date); ?>, à Seraing
</div>

<br />
<br />



<?php

$content = ob_get_contents();
ob_clean();

$mpdf->WriteHTML($content);

$date_jour = date("Y_m_d_h_i_s", time());
$mpdf->SetTitle("Attestation - HEPL - ".$date_jour);
$mpdf->Output("attestation_immersion_hepl_".$date_jour.".pdf", "I");

// Output a PDF file directly to the browser
