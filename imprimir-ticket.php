<?php

    include 'imprimir-plantilla-ticket.php';
    require ('database.php');  
    require 'config.php';

    $conecta = mysqli_connect($server, $nombre, $password, $database);
    if (mysqli_connect_errno())
    {
        $_SESSION['message-error'] = 'Error al conectar la base de datos';
        exit();
    }
    mysqli_select_db($conecta, $database) or die ($_SESSION['message-error'] = 'Error al conectar');
    mysqli_set_charset($conecta, 'utf8');

    $idPedido = '';
    $cliente = '';
    $idCliente = '';
    $total = '';
    $estado = '';

    $pdf = new PDF('P','mm',array(100,150)); 
    $pdf->AliasNbPages();
    $pdf->AddPage();

    if(isset($_GET['vendedor']))
    {
        $url=explode("/", $_GET['vendedor']);
        $vendedor = $url[0];
        $idPedido = $url[1];

            $pdf->Cell(-5);
            $pdf->SetFillColor(999, 999, 999);
            $pdf->SetTextColor(112,112,112);
            $pdf->SetDrawColor(999, 999, 999);
            $pdf->SetFont('Arial','',11);

            $sql="SELECT * FROM id_pedido WHERE id = '$idPedido' ";
            $resultado = mysqli_query($conecta, $sql);
            while($filas = mysqli_fetch_array($resultado, MYSQLI_ASSOC))
            {
                
                $idCliente = $filas['id_cliente'];
                $idPedido = $filas['id']; 
                $entrega = $filas['entrega'];
                $fechaDeEntrega = $filas['fecha_entrega'];
                $estado = $filas['estado'];
                $total = $filas['total'];
                $cabecera = $filas['cabecera'];

                $sql2="SELECT * FROM clientes WHERE id = '$idCliente' ";
                $resultado1 = mysqli_query($conecta, $sql2);
                while($filas = mysqli_fetch_array($resultado1, MYSQLI_ASSOC))
                {
                    $cliente = $filas['nombre'];
                }
                $pdf->Cell (0,6,'Pedido ID: '.$idPedido,1,1,'L',1); 
                $pdf->Cell(-5);
                $pdf->Cell (0,6,'Cliente: '.$cliente,1,1,'L',1); 
                $pdf->Cell(-5);
                $pdf->Cell (0,6,'Domicilio: '.$entrega,1,1,'L',1); 
                $pdf->Cell(-5);
                $pdf->Cell (0,6,'Fecha de entrega: '.$fechaDeEntrega,1,1,'L',1);
                $pdf->Cell(-5);
                $pdf->Cell (0,6,'Estado: '.$estado,1,1,'L',1);
                $pdf->Cell(-5);
                $pdf->Cell (0,6,'Cabecera: '.$cabecera,1,1,'L',1);
                $pdf->Ln(6);         
                $pdf->SetFillColor(5, 85, 189);

                $pdf->SetTextColor(999,999,999);
                $pdf->SetDrawColor(5, 85, 189);
                $pdf->Cell(-5);
                $pdf->SetFont('Arial','B',11);
                $pdf->Cell(10,6, 'Cant.', 1,0,'C',1);
                $pdf->Cell(80,6,'Descripcion',1,0,'C',1);

                $pdf->SetFillColor(999,999,999);
                $pdf->SetTextColor(112,112,112);
                $pdf->SetFont('Arial','',9);
                
                $sql3="SELECT * FROM lista_preparar WHERE id_pedido = '$idPedido' ";
                $resultado3 = mysqli_query($conecta, $sql3);
                while($filas = mysqli_fetch_array($resultado3, MYSQLI_ASSOC))
                {   
                    $pdf->Cell (25,6,'',0,1,'C',0); 
                    $pdf->Cell(-5);
                    $pdf->Cell (10,6, $filas['cantidad'],1,0,'C',1);
                    $pdf->Cell (80,6, $filas['descripcion'],1,0,'C',1);          
                } 
                $pdf->Ln(10); 
                $pdf->Cell (25,6,'Total: $'.$total,1,1,'L',1); 
                $pdf->Ln(10);  

                $pdf->SetFillColor(999, 999, 999);
                $pdf->SetTextColor(112,112,112);
                $pdf->SetDrawColor(999, 999, 999);
                $pdf->SetFont('Arial','',11);
            }            
    }
    $pdf->Output();
    mysqli_close($conexion); 

?>