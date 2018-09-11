<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport">
        <!-- content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1.2"-->
        <link rel="shortcut icon" href="img/icon/icpr.png">
        <title>teste</title>

        <!--CSS-->
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/camp.css">
        <!--JS-->
        <!-- <link type="text/javascript" href="js/basic.js"> -->
        <script type="text/javascript" src="js/basic.js" defer="defer"></script>
        <script charset="utf-8" type="text/javascript" src="js/cep.js" defer="defer"></script>

        <?php
        require_once './class/menu.php';
        ?>

    </head>

    <body>

        <?php
        session_start();
        session_destroy();
        session_abort();
        $obj = new menu();
        $obj->ativoMenu(1);
        ?>


        <!--2 O endereço deverá conter os seguintes campos: Rua*, Número*, CEP*, bairro*, cidade*, UF*, complemento.-->
        <div id="f-corpo">
            <div class="corpo">
                <form method="POST" action="class/cadastrarCliente.php">
                    <fieldset class="cad"><legend><h2>Cadastro</h2></legend>

                        <div class="n-campos">
                            <ul>
                                <li>Nome:*</li>
                                <li>CPF:*</li>
                                <li>RG:</li>
                                <li>Sexo:*</li>
                                <li>Data de Nascimento:*</li>
                                <li>Telefone:</li>
                                <li>Celular:*</li>
                                <li>E-mail:</li>
                            </ul>
                        </div>
                        <div class="campos">
                            <ul>
                                <li><input name="nome" type="text"/></li>
                                <li><input name="cpf" type="text"/></li>
                                <li><input name="rg" type="text"/></li>
                                <li>
                                    <input type="radio" name="sexo" value ="f"/>Feminino&nbsp;&nbsp;&nbsp; 
                                    <input type="radio" name="sexo" value="m"/>Masculino
                                </li>
                                <li><input name="dtnasc" type="date"/></li>
                                <li><input  name="tel" type="text"/></li>


                                <li><input name="tels" type="text"/></li>


                                <li><input name="email" type="email"></li>
                            </ul>
                        </div>




                        <fieldset class="cad-e">
                            <legend><h4>Endereço: *</h4></legend>
                            <div class="n-campos">
                                <ul>
                                    <li>CEP:*</li>
                                    <li>Rua:*</li>
                                    <li>Número:*</li>
                                    <li>Complemento:</li>
                                    <li>Bairro (Jd):*</li>
                                    <li>Cidade:*</li>
                                    <li>UF:*</li>
                                </ul>
                            </div>
                            <div class="campos">
                                <ul>
                                    <li><input  placeholder="00000-000" name="cep" onblur="pesquisacep(this.value);" type="text"/></li>
                                    <li><input maxlength="100" size="65" name="rua" id="rua" type="text"/></li>
                                    <li><input  maxlength="5" size="6" name="numero" id="numero"  type="number"/></li>
                                    <li><input  maxlength="5" size="6" name="comp"  id="comp" type="number"/></li>
                                    <li>
                                        <input maxlength="100" size="65" name="bairro"  id="bairro" type="text"/>
                                    </li>
                                    <li><input maxlength="30" size="40" name="cidade"  id="cidade" type="text"></li>
                                    <li><select name="uf" id="uf">
                                            <option value="">Selecione</option>
                                            <option value="AC">AC</option>
                                            <option value="AL">AL</option>
                                            <option value="AM">AM</option>
                                            <option value="AP">AP</option>
                                            <option value="BA">BA</option>
                                            <option value="CE">CE</option>
                                            <option value="DF">DF</option>
                                            <option value="ES">ES</option>
                                            <option value="GO">GO</option>
                                            <option value="MA">MA</option>
                                            <option value="MG">MG</option>
                                            <option value="MS">MS</option>
                                            <option value="MT">MT</option>
                                            <option value="PA">PA</option>
                                            <option value="PB">PB</option>
                                            <option value="PE">PE</option>
                                            <option value="PI">PI</option>
                                            <option value="PR">PR</option>
                                            <option value="RJ">RJ</option>
                                            <option value="RN">RN</option>
                                            <option value="RS">RS</option>
                                            <option value="RO">RO</option>
                                            <option value="RR">RR</option>
                                            <option value="SC">SC</option>
                                            <option value="SE">SE</option>
                                            <option value="SP">SP</option>
                                            <option value="TO">TO</option>
                                        </select></li>

                                </ul>
                            </div>


                            <p style="display:none;">
                                <input name="ibge" type="text" id="ibge" size="8" />
                            </p>


                        </fieldset>


                        <fieldset class="cad-e">
                            <legend><h4>Endereço:(Opcional)</h4></legend>

                            <div class="n-campos">

                                <ul>
                                    <li>CEP:*</li>
                                    <li>Rua:*</li>
                                    <li>Número:*</li>
                                    <li>Complemento:</li>
                                    <li>Bairro (Jd):*</li>
                                    <li>Cidade:*</li>
                                    <li>UF:*</li>

                                </ul>
                            </div>
                            <div class="campos">
                                <ul>
                                    <li><input  placeholder="00000-000" name="ceps" onblur="pesquisacep(this.value);" type="text"/></li>
                                    <li><input maxlength="100" size="65" name="ruas" id="rua" type="text"/></li>
                                    <li><input  maxlength="5" size="6" name="numeros" id="numero"  type="number"/></li>
                                    <li><input  maxlength="5" size="6" name="comps"  id="comp" type="number"/></li>
                                    <li><input maxlength="100" size="65" name="bairros"  id="bairro" type="text"/></li>
                                    <li><input maxlength="30" size="40" name="cidades"  id="cidade" type="text"></li>
                                    <li><select name="ufs" id="uf">
                                            <option value="">Selecione</option>
                                            <option value="AC">AC</option>
                                            <option value="AL">AL</option>
                                            <option value="AM">AM</option>
                                            <option value="AP">AP</option>
                                            <option value="BA">BA</option>
                                            <option value="CE">CE</option>
                                            <option value="DF">DF</option>
                                            <option value="ES">ES</option>
                                            <option value="GO">GO</option>
                                            <option value="MA">MA</option>
                                            <option value="MG">MG</option>
                                            <option value="MS">MS</option>
                                            <option value="MT">MT</option>
                                            <option value="PA">PA</option>
                                            <option value="PB">PB</option>
                                            <option value="PE">PE</option>
                                            <option value="PI">PI</option>
                                            <option value="PR">PR</option>
                                            <option value="RJ">RJ</option>
                                            <option value="RN">RN</option>
                                            <option value="RS">RS</option>
                                            <option value="RO">RO</option>
                                            <option value="RR">RR</option>
                                            <option value="SC">SC</option>
                                            <option value="SE">SE</option>
                                            <option value="SP">SP</option>
                                            <option value="TO">TO</option>
                                        </select></li>

                                </ul>
                            </div>
                        </fieldset>
                        <div class="n-campos">
                            <ul>
                                <li>Senha:*</li>
                            </ul>
                        </div>
                        <div class="campos">
                            <ul>
                                <li>
                                    <input name="senha" type="text"/>
                                </li>
                            </ul>
                        </div>
                        <p>

                            <input type="submit"  value="Avançar"/>
                        </p>
                    </fieldset>
                </form>
            </div>
            <div class="rodape">
                <div class="textrod">
                    <span>teste</span>
                    <p>₢ - 2018</p>
                </div>
            </div>
        </div>

    </body>
</html>
