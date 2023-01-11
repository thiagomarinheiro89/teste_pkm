<?php
    $sequencia = array(20,65,682,1050,1558,4032,5065,5095,6063,15000);

    $divisao_exata = verificacao($sequencia);

    var_dump($divisao_exata);

    function verificacao($sequencia){
        $retorno = array();

        for ($i=0; $i < count($sequencia)-1; $i++) { 
            $resto = $sequencia[$i+1]-$sequencia[$i];

            if (($resto % 4) == 0) {
                $retorno[] = $resto;
            };
        }

        return $retorno;
    }


?>