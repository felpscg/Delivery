
function TestaCPF(CPF) {
    var idCPF = document.getElementById("cpf");
    CPF = CPF.replace(/[^\d]+/g, '');
    var Soma;
    var Resto;
    Soma = 0;
    if (CPF == "00000000000" ||
            CPF == "11111111111" ||
            CPF == "22222222222" ||
            CPF == "33333333333" ||
            CPF == "44444444444" ||
            CPF == "55555555555" ||
            CPF == "66666666666" ||
            CPF == "77777777777" ||
            CPF == "88888888888" ||
            CPF == "99999999999") {
        return alert("CPF Invalido");
        idCPF.value ="";
    }
    if (CPF == "" || CPF == null){
        return alert("Digite seu CPF");
        }
    for (i = 1; i <= 9; i++)
        Soma = Soma + parseInt(CPF.substring(i - 1, i)) * (11 - i);
    Resto = (Soma * 10) % 11;

    if ((Resto == 10) || (Resto == 11)){
        Resto = 0;
    }
    if (Resto != parseInt(CPF.substring(9, 10))){
        return alert("CPF Invalido");
        }
    Soma = 0;
    for (i = 1; i <= 10; i++)
        Soma = Soma + parseInt(CPF.substring(i - 1, i)) * (12 - i);
    Resto = (Soma * 10) % 11;

    if ((Resto == 10) || (Resto == 11))
        Resto = 0;
    if (Resto != parseInt(CPF.substring(10, 11)))
        
    return alert("CPF Invalido");
    else{
    idCPF.style.border()    
    }
    
    return true;
}



