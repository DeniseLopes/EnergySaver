<?php

/**
 * @author Diego Magno
 */
class Functions {

    //put your code here
    public function trataCaracter($valor, $tipo) {
        switch ($tipo) {
            case 1 :$rst = utf8_decode($valor);
            break;
            case 2: $rst = htmlentities($valor, ENT_QUOTES, "ISO-8859-1");
        }
        return $rst;
    }

    public function dateNow($tipo) {
        switch ($tipo) {
            case 1 : $rst = date("Y-m-d");
            break;
            case 2 : $rst = date("Y-m-d H:i:s");
            break;
            case 2 : $rst = date("d/m/Y ");
            break;
        }
        return $rst;
    }

    public function base64($tipo, $vlr) {
        switch ($getTipo) {
            case 1:base64_encode($vlr);
            break;
            case 2:base64_decode($vlr);
            break;
        }
        return $rst;
    }
    public function getTipo($tipo){
        $retorno="";
        switch ($tipo) {
            case 1:
            $retorno = "Computador";
            break;
            case 2:
            $retorno = "Impressora";
            break;
            case 3:
            $retorno = "Geladeira";
            break;
            case 4:
            $retorno = "Transformador";
            break;
            case 5:
            $retorno = "Ar-condicionado";
            break;
            case 6:
            $retorno = "TV";
            break;
            case 7:
            $retorno = "Radio";
            break;
            default:
                        # code...
            break;
        }
        return $retorno;


    }


}


