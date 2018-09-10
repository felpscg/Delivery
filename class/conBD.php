<?php

/**
 * @name            : conBD
 * @since           : 07/09/2018
 * @author          : felipecg
 */

class conBD {
    
    private $conexao;
    private $host="127.0.0.1";
    private $key="";
    private $userbd="root";
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
        $conTemp = mysqli_connect($this->getHost(), $this->getUserbd(), $this->getKey(), $this->getBd());
        $this->setConexao($conTemp);
        return $this->getConexao();
    }
            
}
//fim classe conBD
