/**
 * @author FELIPECORREAGOMES
 */


function limpa_formulario_cep() {
                        document.getElementById('rua').value=("");
                        document.getElementById('bairro').value=("");
                        document.getElementById('cidade').value=("");
                        document.getElementById('uf').value=("");
                        document.getElementById('ibge').value=("");
        }


    //Atualiza os campos com os valores encontrados no servidor.
        function meu_callback(conteudo) {
                if (!("erro" in conteudo)) {
                        document.getElementById('rua').value=(conteudo.logradouro);
                        document.getElementById('bairro').value=(conteudo.bairro);
                        document.getElementById('cidade').value=(conteudo.localidade);
                        document.getElementById('uf').value=(conteudo.uf);
                        document.getElementById('ibge').value=(conteudo.ibge);
                }
                else {
                        limpa_formulario_cep();
                        alert("CEP não encontrado.");
                }
        }

            function pesquisacep(valor) {

                //variável "cep" recebe somente com dígitos.
                var cep = valor.replace(/\D/g, '');

                //Verifica se campo cep possui valor informado.
                if (cep != "") {

                        //Expressão regular para validar o CEP.
                        var validacep = /^[0-9]{8}$/;

                        //Valida o formato do CEP.
                        if(validacep.test(cep)) {
                        document.getElementById('rua').value="...";
                        document.getElementById('bairro').value="...";
                        document.getElementById('cidade').value="...";
                        document.getElementById('ibge').value="...";
//Cria um elemento javascript.
                                var script = document.createElement('script');
//Sincroniza com o callback.
                                script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';
//Insere script no documento e carrega o conteúdo.
                                document.body.appendChild(script);
                        }
                        else {

                                alert("Formato de CEP inválido.");
                        }
                }
                else {
                        limpa_formulario_cep();
                }
        };
