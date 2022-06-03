function valida_dados(nomeform) {
    if (nomeform.nome.value == "") {
        alert("Por favor digite o nome.");
        return false;
    }

    if (nomeform.cpf.value == "") {
        alert("Por favor digite o cpf ou cnpj.");
        return false;
    }

    if (nomeform.rg_ie.value == "") {
        alert("Por favor digite o RG ou Inscricao Estadual.");
        return false;
    }

    if (nomeform.endereco.value == "") {
        alert("Por favor digite o endereco.");
        return false;
    }

    if (nomeform.bairro.value == "") {
        alert("Por favor digite o bairro.");
        return false;
    }

    if (nomeform.cidade.value == "") {
        alert("Por favor digite a cidade.");
        return false;
    }
    if (nomeform.uf.selectedIndex == 0) {
        alert("Por favor selecione o estado.");
        return false;
    }
    if (nomeform.cep.value == "") {
        alert("Por favor digite o cep.");
        return false;
    }

    if (nomeform.telefone.value == "") {
        alert("Por favor digite o telefone.");
        return false;
    }

    if (nomeform.banco.value == "") {
        alert("Por favor digite o banco.");
        return false;
    }


    if (nomeform.ag.value == "") {
        alert("Por favor digite a agencia bancaria.");
        return false;
    }

    if (nomeform.conta.value == "") {
        alert("Por favor digite a conta.");
        return false;
    }

    if (nomeform.email.value == "" || nomeform.email.value.indexOf('@', 0) == -1 || nomeform.email.value.indexOf('.', 0) == -1) {
        alert("E-mail invalido.");
        return false;
    }

    return true;
}

function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}

function filterFunction() {
    var input, filter, ul, li, a, i;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    div = document.getElementById("myDropdown");
    a = div.getElementsByTagName("a");
    for (i = 0; i < a.length; i++) {
        txtValue = a[i].textContent || a[i].innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            a[i].style.display = "";
        } else {
            a[i].style.display = "none";
        }
    }
}