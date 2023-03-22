<?php

$bruno = array(array(
    'compra' => 'carrefour',
    'data' => '2023-01-19T02:03',
    'formaCompra' => 'creditoParcelado',
    '$resultado' => '2023-12-07T02:03',
    'parcelaCompra' => '4',
    'valor' => '322.1',
));

$date = new DateTime($bruno[0]['$resultado']);
for($i=0; $i < $bruno[0]['parcelaCompra']; $i++){

    $arrayCreditoFinal = [];
    foreach($bruno as $resultado){

            $descricao = $resultado['compra'] . $resultado['parcelaCompra'].'/'. ($i + 1);
            $arrayCreditoFinal['compra'] = $descricao;

            $data = $resultado['data'];
            $arrayCreditoFinal['data'] = $data;

            $formaCompra = $resultado['formaCompra'];
            $arrayCreditoFinal['formaCompra'] = $formaCompra;

            if($resultado['$resultado']){
                if($i != 0){
                    $date = ($date->add(new DateInterval('P1M')));
                    $dateNew = (array)$date;
                }else{
                    $dateNew = (array)$date;
                }
                $dateNew =  str_replace(' ','T',(substr($dateNew['date'],0,16)));
                $arrayCreditoFinal['resultado'] = $dateNew;
                }

                $valor = number_format($resultado['valor'] / $resultado['parcelaCompra'],2) ;
                $arrayCreditoFinal['valorFinal'] = $valor;

            }
            //AQUI ENTRA O BANCO DE DADOS
            echo '<pre>';
            print_r($arrayCreditoFinal);
            echo '</pre>';
            // exit();
                
            }