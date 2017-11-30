<?php
  include 'fpdf.php';
  include 'PDF2.php';
  $pdf = new PDF;
  $pdf->AddPage();
  $pdf->SetFont('Arial','B',16);
  $pdf->Cell(40,10,"Commande effectuée dans la ville de " . ucfirst($_SESSION['VilleSelected']) . " : ");
  $pdf->Ln(20);
  $pdf->Cell(40,10,ucfirst($_SESSION['nomSelected']));
  $pdf->Ln(20);
  $pdf->Cell(40,10,ucfirst($_SESSION['modePaiement']));
  $pdf->Ln(20);
  $pdf->Cell(40,10,ucfirst($_SESSION['dateLivraison']));
  $pdf->Ln(20);
  $pdf->Cell(40,10,ucfirst($_SESSION['lieuLivraison']));
  $pdf->Ln(20);
/*  foreach ($_SESSION['lePanier']->getLesPlats() as $OBJ){
    $pdf->Cell(40,10,$OBJ->getNom());
    $pdf->Ln(20);
  }*/
?>
