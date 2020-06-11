<?php

    include 'imprimir-plantilla.php';
    require ('database.php');  

    $conecta = mysqli_connect($server, $nombre, $password, $database);
    if (mysqli_connect_errno())
    {
        $_SESSION['message-error'] = 'Error al conectar la base de datos';
        exit();
    }
    mysqli_select_db($conecta, $database) or die ($_SESSION['message-error'] = 'Error al conectar');
    mysqli_set_charset($conecta, 'utf8');

    $idPedido = '';

    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();

    $pdf->SetFillColor(5, 85, 189);
    $pdf->SetTextColor(999,999,999);
    $pdf->SetDrawColor(5, 85, 189);
    $pdf->SetFont('Arial','B',11);
    $pdf->Cell(25,6, 'Cantidad', 1,0,'C',1);
    $pdf->Cell(35,6,'Descuento',1,0,'C',1);
    $pdf->Cell(40,6,'IVA condicional',1,0,'C',1);
    $pdf->Cell(70,6,'Descripcion',1,0,'C',1);
    $pdf->Cell(20,6,'Precio',1,0,'C',1);

    $pdf->SetFillColor(999,999,999);
    $pdf->SetTextColor(112,112,112);
    $pdf->SetFont('Arial','',9);

    if(isset($_GET['id']))
    {
        $idPedido = $_GET['id'];

        $sql="SELECT * FROM lista WHERE id_pedido = '$idPedido' ";
        $resultado = mysqli_query($conecta, $sql);
        while($filas = mysqli_fetch_array($resultado, MYSQLI_ASSOC))
        {   
            $pdf->Cell (25,6,'',0,1,'C',0); 
            $pdf->Cell (25,6, $filas['cantidad'],1,0,'C',1);    
            $pdf->Cell (35,6, $filas['descuento'],1,0,'C',1);
            $pdf->Cell (40,6, $filas['condicionIva'].'%',1,0,'C',1);
            $pdf->Cell (70,6, $filas['descripcion'],1,0,'C',1);
            $pdf->Cell (20,6,'$'.$filas['precio'],1,0,'C',1);
        }
    }
    $pdf->Output();
?>