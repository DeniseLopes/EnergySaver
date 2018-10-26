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
        switch ($tipo) {
            case 1:base64_encode($vlr);
                break;
            case 2:base64_decode($vlr);
                break;
        }
        return $rst;
    }

}
