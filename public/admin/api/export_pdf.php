<?php
//-- ---------------------------------------------------- -->
//--Auteurs : COLLETTE Loic et DELAVAL Kevin              -->
//--Groupe : 2203                                         -->
//--Labo : Programmation Web avancée                      -->
//--Application : Site d'immersion à l'école              -->
//--Date de la dernière mise à jour : [DATE DU JOUR]      -->
//-- ---------------------------------------------------- -->

require_once(__DIR__ . "/../../php/require_all.php");
require_once(__DIR__ . "/../../../mpdf-6.1.3/mpdf.php");

if(!isset($_GET["data"])){
    $qrcode = false;
}else{
    $qrcode = true;
    $data = $_GET["data"];
}

if(!isset($_GET["nom"], $_GET["prenom"], $_GET["admin"])){
    die("Nom/Prenom/Admin manquant !");
}

$mpdf = new Mpdf();
ob_start();


$date = date("d/m/Y", time());

$mpdf->showWatermarkText = true;
$mpdf->SetProtection([], "", "");

?>

    <div style="text-align: right">
        Seraing, le <?php echo($date); ?>.
    </div>
    <img style="width: 120px; height: auto" src="/img/logo-rouge.png"/>
    <br/><br/>
    <div style="text-align: left">
        Haute École de la province de Liège<br/>
        Rue Peetermans, 81<br/>
        4100, Seraing<br/>
        Belgique
    </div>
    <br/>
    <br/>
    <p>
        Je sousigné <?php echo($_GET["admin"]); ?>
        <br/>
        <br/>
        Atteste bien que <?php echo($_GET["nom"]." ".$_GET["prenom"]); ?> à bien assisté aux cours d'immersion ce <?php echo($date); ?> à la HEPL de Seraing
        situé Rue Peetermans, 81 à 4100 Seraing.
        <br/>
        <br/>

    <div style="text-align: right">
        Fait le <?php echo($date); ?>, à Seraing<br /><br /><br />
        ..............................
    </div>

    <br/>
<?php if($qrcode){ ?>
    <hr/>
    <h4>Donnez-nous votre avis ! </h4>
    <p>Aidez-nous à améliorer nos journée d'immersion en donnant votre avis, scannez le code QR avec votre smartphone, et donnez votre avis!</p>
    <img src="./get_qr_code.php?data=http://<?php echo($_SERVER["HTTP_HOST"] . "/qr.php?data=".$data); ?>"/>
<?php } ?>

<?php


$content = ob_get_contents();
ob_clean();

$mpdf->WriteHTML($content);

$date_jour = date("Y_m_d_h_i_s", time());
$mpdf->SetTitle("Attestation - HEPL - " . $date_jour);
$mpdf->Output("attestation_immersion_hepl_" . $date_jour . ".pdf", "I");

// Output a PDF file directly to the browser
