function limpa_formulário_cep() {
    document.getElementById("rua").value = "";
    document.getElementById("cidade").value = "";
    document.getElementById("uf").value = "";
}

function meu_callback(conteudo) {
    if (!("erro" in conteudo)) {
        document.getElementById("rua").value = conteudo.logradouro;
        document.getElementById("cidade").value = conteudo.localidade;
        document.getElementById("uf").value = conteudo.uf;
    } else {
        limpa_formulário_cep();
        alert("CEP não encontrado.");
    }
}

function pesquisacep(valor) {
    var cep = valor.replace(/\D/g, "");
    if (cep != "") {
        var validacep = /^[0-9]{8}$/;

        if (validacep.test(cep)) {
            document.getElementById("rua").value = "procurando...";
            document.getElementById("cidade").value = "procurando...";
            document.getElementById("uf").value = "procurando...";

            var script = document.createElement("script");
            script.src =
                "https://viacep.com.br/ws/" + cep + "/json/?callback=meu_callback";

            document.body.appendChild(script);
        } else {
            limpa_formulário_cep();
            alert("Formato de CEP inválido.");
        }
    } else {
        limpa_formulário_cep();
    }
}

function mascaraCnpj(i) {
    var v = i.value;

    if (isNaN(v[v.length - 1])) {
        i.value = v.substring(0, v.length - 1);
        return;
    }
    i.setAttribute("maxlength", "18");
    if (v.length == 2 || v.length == 6) i.value += ".";
    if (v.length == 10) i.value += "/";
    if (v.length == 15) i.value += "-";
}