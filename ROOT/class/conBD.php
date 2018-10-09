<?php

/**
 * @name            : conBD
 * @since           : 07/09/2018
 * @author          : felipecg
 */

class conBD {
    
    private $conexao;
    private $host="localhost";
    private $key="";
    private $userbd="root";
//    private $key="";
//    private $userbd="root";
    private $bd="bddelivery";
    function getConexao() {
        return $this->conexao;
    }

    function setConexao($conexao) {
        $this->conexao = $conexao;
    }

    function getHost() {
        return $this->host;
    }

    function getKey() {
        return $this->key;
    }

    function getUserbd() {
        return $this->userbd;
    }

    function getBd() {
        return $this->bd;
    }

        
    public function conBD() {
        $conTemp = mysqli_connect($this->getHost(), $this->getUserbd(), $this->getKey(), $this->getBd()) or die ("Erro de Conexão");
        mysqli_set_charset($conTemp, "utf8");
        $this->setConexao($conTemp);
        return $this->getConexao();
    }
            
}
//fim classe conBD
