<?php

    require 'assets/plugins/fpdf/fpdf.php';

    class PDF extends FPDF
    {
        function Header()
        {
            $this->Image('assets/img/logo.png', 5, 5, 20);
            $this->SetTextColor(112,112,112);
            $this->SetFont('Arial','',25);
            $this->Cell(30);
            $this->Cell(0, 20, 'Pedidos Forcinitti', 0, 0, 'L');

            $this->Ln(30);
        }
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
?>