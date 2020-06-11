<?php

    require 'assets/plugins/fpdf/fpdf.php';

    class PDF extends FPDF
    {
        function Header()
        {
            $this->Image('assets/img/logo.png', 10, 10, 20);
            $this->SetTextColor(112,112,112);
            $this->SetFont('Arial','B',25);
            $this->Cell(30);
            $this->Cell(120, 20, 'Pedidos', 0, 0, 'C');

            $this->Ln(30);
        }
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Pagina '.$this->PageNo().'/{nb}', 0, 0, 'C' );
    }
?>