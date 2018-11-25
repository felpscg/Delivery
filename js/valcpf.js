var idCPF = document.getElementById("cpf");

function TestaCPF() {
    var CPF = idCPF.value;
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
        erroCPF(1);
    }
    else if (CPF == "" || CPF == null) {
        erroCPF(2);
    }
    for (i = 1; i <= 9; i++)
        Soma = Soma + parseInt(CPF.substring(i - 1, i)) * (11 - i);
    Resto = (Soma * 10) % 11;
    
    if ((Resto == 10) || (Resto == 11)) {
        Resto = 0;
    }
    else if (Resto != parseInt(CPF.substring(9, 10))) {
        erroCPF(1);
    }
    Soma = 0;
    for (i = 1; i <= 10; i++)
        Soma = Soma + parseInt(CPF.substring(i - 1, i)) * (12 - i);
    Resto = (Soma * 10) % 11;

    if ((Resto == 10) || (Resto == 11))
        Resto = 0;
    else if (Resto != parseInt(CPF.substring(10, 11))) {
        erroCPF(1);
    } 
    else {
        idCPF.style = "border: solid 1px #0f0";
        return;
    }

    return ;
}


function erroCPF(val) {
    switch (val) {
        case 1:
            idCPF.style = "border: solid 2px #f00";
//            idCPF.focus();
            
            alert("CPF Invalido");
            
            break;

        case 2:
            idCPF.style = "border: solid 2px #f00";
            idCPF.value = "";
//            idCPF.focus();
            
            alert("Digite seu CPF");
            
            
            break;

        default:
return;
            break;
    }
}