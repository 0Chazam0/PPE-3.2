<?php
  include 'fpdf.php';
  include 'PDF2.php';

  $pdf = new PDF;
  $pdf->AddPage();
  $pdf->SetFont('Arial','B',16);
  $pdf->Cell(60,10,"INFORMATION DU CLIENT " );
  $pdf->Ln(10);
  $pdf->Cell(40,10,"Nom client :  " . utf8_decode(ucfirst($_SESSION['identite'][1])));
  $pdf->Ln(7);
  $pdf->Cell(40,10,"Prenom client :  " . utf8_decode(ucfirst($_SESSION['identite'][2])));
  $pdf->Ln(7);
  $pdf->Cell(40,10,"Email client :  " . utf8_decode(ucfirst($_SESSION['identite'][3])));
  $pdf->Ln(15);
  $pdf->Cell(60,10,"INFORMATION DE LA COMMANDE " );
  $pdf->Ln(10);
  $pdf->Cell(40,10,"Ville :  " . utf8_decode(ucfirst($_SESSION['VilleSelected'])));
  $pdf->Ln(7);
  $pdf->Cell(40,10,"Restaurant : ". utf8_decode(ucfirst($_SESSION['nomSelected'])));
  $pdf->Ln(7);
  $pdf->Cell(40,10,"Mode de paiement : ". utf8_decode(ucfirst($_SESSION['modePaiement'])));
  $pdf->Ln(7);
  $pdf->Cell(40,10,"Date de livraison : le " . utf8_decode(ucfirst($_SESSION['dateLivraison'])));
  $pdf->Ln(7);
  $pdf->Cell(40,10, "Lieu de livraison : ". utf8_decode(ucfirst($_SESSION['lieuLivraison'])));
  $pdf->Ln(7);
  $pdf->Image('image\travailEnCours.jpg',35,125,'L');
  $pdf->Ln(150);

 // foreach ($_SESSION['lePanier']->getLesPlats() as $OBJ){
 //    $pdf->Cell(40,10,$OBJ->getNom());
 //    $pdf->Ln(20);
 //  }
?>
