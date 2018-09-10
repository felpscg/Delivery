<?php


/**
 * @name            : clienteDAO
 * @since           : 07/09/2018
 * @author          : felipecg

 */
require_once './conBD.php';
class clienteDAO {
    private $conBD;
    function getConBD() {
        return $this->conBD;
    }

    function setConBD($conBD) {
        $this->conBD = $conBD;
    }

    public function inserirCliente($var_camp) {
$tempobj = new conBD();
$varcamp;


$query = "INSERT INTO bddelivery.clientes 
(nomecliente,rg,cpf,sexo,datanasc,telefone,telefone2,email,senha)
 VALUES 
 ('$var_camp[1]',
 '$var_camp[2]',
 '$var_camp[3]',
 '$var_camp[4]',
 '$var_camp[5]',
 '$var_camp[6]',
 '$var_camp[7]',
 '$var_camp[8]',
 '$var_camp[9]');";



$this->setConbd($tempobj ->conBD()) ;
$temp = mysqli_query($this->getConBD(), $query);

}
    
}

//fim classe clienteDAO
