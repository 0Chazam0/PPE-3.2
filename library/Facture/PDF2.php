<?php
  class PDF extends FPDF{
    function Header(){
      $this->Image('image\logo.jpeg',10,10,30);
      $this->SetFont('Arial','B',15);
      $this->Cell(70);
      $this->Cell(60,15,'Votre commande',1,0,'C');
      $this->Ln(20);
    }
    function Footer(){
      $this->SetFont('Arial','I',8);
      $this->Cell(0,10,'Page ' .$this->PageNo(),1,0,'R');
    }
    function Corps($text){
      $this->SetFont('Times','',12);
      $this->MultiCell(0,5,$text);
    }
    function Tablo($header, $data){

      foreach($header as $col){
        $this->Cell(30,7,$col,1);
      }
      $this->Ln();
      foreach ($data as $lig) {
        foreach ($lig as $cell) {
            $this->Cell(30,5,$cell,1);
        }
        $this->Ln();
      }
    }
}
?>
