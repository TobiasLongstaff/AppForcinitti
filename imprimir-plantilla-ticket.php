<?php

    require 'assets/plugins/fpdf/fpdf.php';

    class PDF extends FPDF
    {
        function Header()
        {
            $this->Image('assets/img/logo.png', 15, 10, 13);
            $this->SetTextColor(112,112,112);
            $this->SetFont('Arial','',20);
            $this->Cell(20);
            $this->Cell(0, 12, 'Pedidos Forcinitti', 0, 0, 'L');

            $this->Ln(15);
        }
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
?>